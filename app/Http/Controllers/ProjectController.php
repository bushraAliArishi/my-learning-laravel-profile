<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        // Example filtering logic; adapt as needed
        $query = Project::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($tags = $request->input('tags', [])) {
            $query->whereHas('tags', fn($q) => $q->whereIn('tags.id', $tags));
        }

        if ($tools = $request->input('tools', [])) {
            $query->whereHas('tools', fn($q) => $q->whereIn('tools.id', $tools));
        }

        $projects = $query->with(['media','tags','tools'])->paginate(12);
        $allTypes = Project::select('type')->distinct()->pluck('type')->all();
        $allTags  = Tag::all();
        $allTools = Tool::all();

        return view('projects.index', compact('projects','allTypes','allTags','allTools'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $allTypes = Project::select('type')->distinct()->pluck('type')->all();
        $allTags  = Tag::all();
        $allTools = Tool::all();

        return view('projects.create', compact('allTypes','allTags','allTools'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'type'        => 'required|string',
            'type_other'  => 'required_if:type,__other|string|max:255',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
            'tools'       => 'nullable|array',
            'tools.*'     => 'integer|exists:tools,id',
            'media'       => 'nullable|array',
            'media.*'     => 'image|max:2048',
        ]);

        if ($data['type'] === '__other') {
            $data['type'] = $data['type_other'];
        }
        unset($data['type_other']);

        $project = Project::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'type'        => $data['type'],
        ]);

        $project->tags()->sync($data['tags'] ?? []);
        $project->tools()->sync($data['tools'] ?? []);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('projects');
                $project->media()->create([
                    'media_url'  => $path,
                    'media_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()
            ->route('projects.index')
            ->with('success','Project created.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $allTypes = Project::select('type')->distinct()->pluck('type')->all();
        $allTags  = Tag::all();
        $allTools = Tool::all();

        return view('projects.edit', compact('project','allTypes','allTags','allTools'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'type'          => 'required|string',
            'type_other'    => 'required_if:type,__other|string|max:255',
            'tags'          => 'nullable|array',
            'tags.*'        => 'integer|exists:tags,id',
            'tools'         => 'nullable|array',
            'tools.*'       => 'integer|exists:tools,id',
            'media'         => 'nullable|array',
            'media.*'       => 'image|max:2048',
            'remove_media'  => 'nullable|array',
            'remove_media.*'=> 'integer|exists:project_media,id',
        ]);

        if ($data['type'] === '__other') {
            $data['type'] = $data['type_other'];
        }
        unset($data['type_other']);

        // Update core fields
        $project->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'type'        => $data['type'],
        ]);

        // Sync pivot relations
        $project->tags()->sync($data['tags'] ?? []);
        $project->tools()->sync($data['tools'] ?? []);

        // Remove checked media
        if (!empty($data['remove_media'])) {
            foreach ($data['remove_media'] as $mediaId) {
                if ($m = $project->media()->find($mediaId)) {
                    Storage::delete($m->media_url);
                    $m->delete();
                }
            }
        }

        // Add newly uploaded images
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('projects');
                $project->media()->create([
                    'media_url'  => $path,
                    'media_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()
            ->route('projects.index')
            ->with('success','Project updated.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        // Delete associated media files
        foreach ($project->media as $m) {
            Storage::delete($m->media_url);
        }
        $project->media()->delete();

        // Detach pivot
        $project->tags()->detach();
        $project->tools()->detach();

        // Finally delete project
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success','Project deleted.');
    }
}
