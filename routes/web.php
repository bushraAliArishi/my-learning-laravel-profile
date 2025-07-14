<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Tool;
use App\Models\Project;
use App\Models\Experience;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Everything lives here as simple route‐closures—no controllers needed yet.
|
*/

// ─────────────────────────────────────────────────────────────────────────────
// Home / About / Contact
// ─────────────────────────────────────────────────────────────────────────────
Route::view('/',        'home',    ['title' => 'Home',     'heading' => 'Welcome'])->name('home');
Route::view('/about',   'about',   ['title' => 'About Us', 'heading' => 'Learn More'])->name('about');
Route::view('/contact', 'contact', ['title' => 'Contact',  'heading' => 'Get in Touch'])->name('contact');

// ─────────────────────────────────────────────────────────────────────────────
// Tags: inline “add new tag” endpoint
// ─────────────────────────────────────────────────────────────────────────────
Route::post('/tags', function (Request $r) {
    $data = $r->validate([
        'name'  => ['required','string','max:255','unique:tags,name'],
        'color' => ['required','string','size:7'],
    ]);
    Tag::create([
        'name'      => $data['name'],
        'color_hex' => $data['color'],
    ]);
    return back();
})->name('tags.store');

// ─────────────────────────────────────────────────────────────────────────────
// Tools: inline “add new tool” endpoint
// ─────────────────────────────────────────────────────────────────────────────
Route::post('/tools', function (Request $r) {
    $data = $r->validate([
        'name' => ['required','string','max:255','unique:tools,name'],
        'logo' => ['nullable','image','max:2048'],
    ]);
    $logoPath = $r->hasFile('logo')
        ? $r->file('logo')->store('tools','public')
        : null;
    Tool::create([
        'name' => $data['name'],
        'logo' => $logoPath ? "/storage/{$logoPath}" : null,
    ]);
    return back();
})->name('tools.store');

// ─────────────────────────────────────────────────────────────────────────────
// Projects
// ─────────────────────────────────────────────────────────────────────────────

// 1) List & filter projects
Route::get('/projects', function (Request $request) {
    $allTags   = Tag::orderBy('name')->get();
    $allTools  = Tool::orderBy('name')->get();
    $allTypes  = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

    $query = Project::with(['media','tags','tools']);

    if ($s = $request->input('search')) {
        $query->where(fn($q) =>
            $q->where('title','like',"%{$s}%")
              ->orWhere('description','like',"%{$s}%")
        );
    }

    if ($t = $request->input('type')) {
        $query->where('type', $t);
    }

    if ($tags = $request->input('tags', [])) {
        $query->whereHas('tags', fn($q) => $q->whereIn('tags.id',$tags));
    }

    if ($tools = $request->input('tools', [])) {
        $query->whereHas('tools', fn($q) => $q->whereIn('tools.id',$tools));
    }

    $projects = $query
        ->orderBy('created_at')
        ->paginate(6)
        ->withQueryString();

    return view('projects.index', [
        'title'      => 'Projects',
        'heading'    => 'My Projects',
        'projects'   => $projects,
        'allTags'    => $allTags,
        'allTools'   => $allTools,
        'allTypes'   => $allTypes,
    ]);
})->name('projects.index');

// 2) Show “create project” form
Route::get('/projects/create', function () {
    $allTags   = Tag::orderBy('name')->get();
    $allTools  = Tool::orderBy('name')->get();
    $allTypes  = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

    return view('projects.create', [
        'title'    => 'Create Project',
        'heading'  => 'Add New Project',
        'allTags'  => $allTags,
        'allTools' => $allTools,
        'allTypes' => $allTypes,
    ]);
})->name('projects.create');

// 3) Handle project creation
Route::post('/projects', function (Request $r) {
    $data = $r->validate([
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

    if (($data['type'] ?? '') === 'other' && $data['new_type']) {
        $data['type'] = $data['new_type'];
    }
    unset($data['new_type']);

    $proj = Project::create([
        'slug'        => Str::slug($data['title']),
        'title'       => $data['title'],
        'link'        => $data['link'] ?? null,
        'description' => $data['description'] ?? null,
        'type'        => $data['type'] ?? null,
    ]);

    $proj->tags()->sync($data['tags'] ?? []);
    $proj->tools()->sync($data['tools'] ?? []);

    if ($r->hasFile('media')) {
        foreach ($r->file('media') as $file) {
            $path = $file->store('project_media','public');
            $proj->media()->create([
                'media_url'  => "/storage/{$path}",
                'media_type' => 'image',
            ]);
        }
    }

    return redirect()->route('projects.index');
})->name('projects.store');

// 4) Show “edit project” form
Route::get('/projects/{slug}/edit', function (string $slug) {
    $project  = Project::with(['tags','tools','media'])->where('slug',$slug)->firstOrFail();
    $allTags  = Tag::orderBy('name')->get();
    $allTools = Tool::orderBy('name')->get();
    $allTypes = Project::whereNotNull('type')->distinct()->pluck('type')->toArray();

    return view('projects.edit', [
        'title'     => $project->title,
        'heading'   => "Edit Project: {$project->title}",
        'project'   => $project,
        'allTags'   => $allTags,
        'allTools'  => $allTools,
        'allTypes'  => $allTypes,
    ]);
})->name('projects.edit');

// 5) Handle project update
Route::put('/projects/{slug}', function (Request $r, string $slug) {
    $proj = Project::where('slug',$slug)->firstOrFail();

    $data = $r->validate([
        'title'       => "required|string|max:255|unique:projects,title,{$proj->id}",
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

    $proj->update([
        'slug'        => Str::slug($data['title']),
        'title'       => $data['title'],
        'link'        => $data['link'] ?? null,
        'description' => $data['description'] ?? null,
        'type'        => $data['type'] ?? null,
    ]);

    $proj->tags()->sync($data['tags'] ?? []);
    $proj->tools()->sync($data['tools'] ?? []);

    if ($r->hasFile('media')) {
        foreach ($r->file('media') as $file) {
            $path = $file->store('project_media','public');
            $proj->media()->create([
                'media_url'  => "/storage/{$path}",
                'media_type' => 'image',
            ]);
        }
    }

    return redirect()->route('projects.index');
})->name('projects.update');

// 6) Show a single project
Route::get('/projects/{slug}', function (string $slug) {
    $project = Project::with(['media','tags','tools'])
                      ->where('slug',$slug)
                      ->firstOrFail();

    return view('projects.show', [
        'title'     => $project->title,
        'heading'   => $project->title,
        'project'   => $project,
    ]);
})->name('projects.show');


// ─────────────────────────────────────────────────────────────────────────────
// Experience
// ─────────────────────────────────────────────────────────────────────────────

// 1) List all experiences
Route::get('/experience', function () {
    $experiences = Experience::with(['skills','achievements','tools'])
                             ->orderBy('start_date','desc')
                             ->get();

    return view('experience.index', [
        'title'       => 'All Experience',
        'heading'     => 'Learn More About Me',
        'experiences' => $experiences,
    ]);
})->name('experience.index');

// 2) Show “create experience” form
Route::get('/experience/create', function () {
    $allTools = Tool::orderBy('name')->get();

    return view('experience.create', [
        'title'    => 'Add New Experience',
        'heading'  => 'Create an Experience Entry',
        'allTools' => $allTools,
    ]);
})->name('experience.create');

// 3) Handle experience creation
Route::post('/experience', function (Request $r) {
    $data = $r->validate([
        'slug'        => 'required|string|unique:experiences,slug',
        'title'       => 'required|string|max:255',
        'company'     => 'required|string|max:255',
        'period'      => 'required|string|max:255',
        'details'     => 'required|string',
        'start_date'  => 'nullable|date',
        'end_date'    => 'nullable|date',
        'tools'       => 'array',
        'tools.*'     => 'exists:tools,id',
    ]);

    $exp = Experience::create([
        'slug'       => $data['slug'],
        'title'      => $data['title'],
        'company'    => $data['company'],
        'period'     => $data['period'],
        'details'    => $data['details'],
        'start_date' => $data['start_date'] ?? null,
        'end_date'   => $data['end_date']   ?? null,
    ]);

    $exp->tools()->sync($data['tools'] ?? []);

    return redirect()->route('experience.index');
})->name('experience.store');

// 4) Show “edit experience” form
Route::get('/experience/{slug}/edit', function (string $slug) {
    $exp      = Experience::with(['skills','achievements','tools'])->where('slug',$slug)->firstOrFail();
    $allTools = Tool::orderBy('name')->get();

    return view('experience.edit', [
        'title'    => $exp->title,
        'heading'  => "Edit Experience: {$exp->title}",
        'exp'      => $exp,
        'allTools' => $allTools,
    ]);
})->name('experience.edit');

// 5) Handle experience update
Route::put('/experience/{slug}', function (Request $r, string $slug) {
    $exp = Experience::where('slug',$slug)->firstOrFail();

    $data = $r->validate([
        'slug'        => "required|string|unique:experiences,slug,{$exp->id}",
        'title'       => 'required|string|max:255',
        'company'     => 'required|string|max:255',
        'period'      => 'required|string|max:255',
        'details'     => 'required|string',
        'start_date'  => 'nullable|date',
        'end_date'    => 'nullable|date',
        'tools'       => 'array',
        'tools.*'     => 'exists:tools,id',
    ]);

    $exp->update([
        'slug'       => $data['slug'],
        'title'      => $data['title'],
        'company'    => $data['company'],
        'period'     => $data['period'],
        'details'    => $data['details'],
        'start_date' => $data['start_date'] ?? null,
        'end_date'   => $data['end_date']   ?? null,
    ]);

    $exp->tools()->sync($data['tools'] ?? []);

    return redirect()->route('experience.show', $exp->slug);
})->name('experience.update');

// 6) Show a single experience
Route::get('/experience/{slug}', function (string $slug) {
    $exp = Experience::with(['skills','achievements','tools'])
                     ->where('slug',$slug)
                     ->firstOrFail();

    return view('experience.show', [
        'title'   => $exp->title,
        'heading' => "{$exp->company} • {$exp->period}",
        'exp'     => $exp,
    ]);
})->name('experience.show');
