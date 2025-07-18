<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Tool;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $allTags  = Tag::orderBy('name')->get();
        $allTools = Tool::orderBy('name')->get();
        $allTypes = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

        $query = Project::with(['media','tags','tools']);

        if ($s = $request->input('search')) {
            $query->where(fn($q) =>
                $q->where('title','like',"%{$s}%")
                  ->orWhere('description','like',"%{$s}%")
            );
        }
        if ($t = $request->input('type')) {
            $query->where('type',$t);
        }
        if ($tags = $request->input('tags',[])) {
            $query->whereHas('tags', fn($q)=> $q->whereIn('tags.id',$tags));
        }
        if ($tools = $request->input('tools',[])) {
            $query->whereHas('tools', fn($q)=> $q->whereIn('tools.id',$tools));
        }

        $projects = $query
            ->orderBy('created_at')
            ->paginate(6)
            ->withQueryString();

        return view('projects.index', compact('projects','allTags','allTools','allTypes'))
               ->with(['title'=>'Projects','heading'=>'My Projects']);
    }

    public function create()
    {
        $allTags  = Tag::orderBy('name')->get();
        $allTools = Tool::orderBy('name')->get();
        $allTypes = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

        return view('projects.create', compact('allTags','allTools','allTypes'))
               ->with(['title'=>'Create Project','heading'=>'Add New Project']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'link'        => 'nullable|url',
            'description' => 'nullable|string',
            'type'        => 'nullable|string|max:255',
            'new_type'    => 'nullable|string|max:255',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
            'tools'       => 'array',
            'tools.*'     => 'exists:tools,id',
            'media.*'     => 'nullable|image|max:2048',
        ]);

        // if user selected "other"
        if (($data['type'] ?? '') === 'other' && $data['new_type']) {
            $data['type'] = $data['new_type'];
        }
        unset($data['new_type']);

        $proj = Project::create([
            'title'       => $data['title'],
            'link'        => $data['link'] ?? null,
            'description' => $data['description'] ?? null,
            'type'        => $data['type'] ?? null,
        ]);

        // prefix slug with ID for uniqueness
        $proj->slug = "{$proj->id}-".Str::slug($proj->title);
        $proj->save();

        $proj->tags()->sync($data['tags'] ?? []);
        $proj->tools()->sync($data['tools'] ?? []);

        if ($request->hasFile('media')) {
            foreach($request->file('media') as $file) {
                $path = $file->store('project_media','public');
                $proj->media()->create([
                    'media_url'  => "/storage/{$path}",
                    'media_type' => 'image',
                ]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        $allTags  = Tag::orderBy('name')->get();
        $allTools = Tool::orderBy('name')->get();
        $allTypes = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

        return view('projects.edit', compact('project','allTags','allTools','allTypes'))
               ->with(['title'=>$project->title,'heading'=>"Edit Project: {$project->title}"]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => "required|string|max:255|unique:projects,title,{$project->id}",
            'link'        => 'nullable|url',
            'description' => 'nullable|string',
            'type'        => 'nullable|string|max:255',
            'new_type'    => 'nullable|string|max:255',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
            'tools'       => 'array',
            'tools.*'     => 'exists:tools,id',
            'media.*'     => 'nullable|image|max:2048',
        ]);

        if (($data['type'] ?? '') === 'other' && $data['new_type']) {
            $data['type'] = $data['new_type'];
        }
        unset($data['new_type']);

        $project->update([
            'title'       => $data['title'],
            'link'        => $data['link'] ?? null,
            'description' => $data['description'] ?? null,
            'type'        => $data['type'] ?? null,
        ]);

        $project->slug = "{$project->id}-".Str::slug($project->title);
        $project->save();

        $project->tags()->sync($data['tags'] ?? []);
        $project->tools()->sync($data['tools'] ?? []);

        if ($request->hasFile('media')) {
            foreach($request->file('media') as $file) {
                $path = $file->store('project_media','public');
                $project->media()->create([
                    'media_url'  => "/storage/{$path}",
                    'media_type' => 'image',
                ]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
