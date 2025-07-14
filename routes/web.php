<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Tool;
use App\Models\Project;
use App\Models\Experience;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Home, About & Contact
Route::view('/',           'home',        ['title' => 'Home',     'heading' => 'Welcome to Our Learning App']);
Route::view('/about',      'about',       ['title' => 'About Us', 'heading' => 'Learn More About Us']);
Route::view('/about-us',   'about-us',    ['title' => 'About Me', 'heading' => 'Learn More About Me']);
Route::view('/contact',    'contact',     ['title' => 'Contact Us','heading' => 'Get in Touch']);
// web.php
Route::post('/tags',  [TagController::class,  'store'])->name('tags.store');
Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');


// ----------------------------------------------------------------------------
// Projects
// ----------------------------------------------------------------------------

Route::get('/projects', function (Request $request) {
    $allTags  = Tag::orderBy('name')->get();
    $allTools = Tool::orderBy('name')->get();

    $query = Project::with(['media','tags','tools']);

    if ($search = $request->input('search')) {
        $query->where(function($q) use($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($tags = $request->input('tags', [])) {
        $query->whereHas('tags', fn($q) => $q->whereIn('tags.id', $tags));
    }

    if ($tools = $request->input('tools', [])) {
        $query->whereHas('tools', fn($q) => $q->whereIn('tools.id', $tools));
    }

    $projects = $query
        ->orderBy('created_at','asc')
        ->paginate(6)
        ->withQueryString();

    return view('projects.index', compact('projects','allTags','allTools'));
})->name('projects.index');

Route::get('/projects/create', function () {
    $allTags  = Tag::orderBy('name')->get();
    $allTools = Tool::orderBy('name')->get();
    return view('projects.create', compact('allTags','allTools'));
})->name('projects.create');

Route::post('/projects', function (Request $request) {
    $data = $request->validate([
        'title'       => 'required|string|max:255',
        'link'        => 'required|url',
        'type'        => 'required|string|max:255',
        'description' => 'required|string',
        'tags'        => 'array',
        'tags.*'      => 'exists:tags,id',
        'tools'       => 'array',
        'tools.*'     => 'exists:tools,id',
    ]);

    $project = Project::create($data);

    // attach any selected tags & tools
    $project->tags()->sync($request->input('tags', []));
    $project->tools()->sync($request->input('tools', []));

    return redirect()
        ->route('projects.index')
        ->with('success','Project created!');
})->name('projects.store');

// ----------------------------------------------------------------------------
// Experience
// ----------------------------------------------------------------------------

// 1) List all experiences
Route::get('/experience', function() {
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
Route::get('/experience/create', function() {
    $allTools = Tool::orderBy('name')->get();

    return view('experience.create', [
        'title'    => 'Add New Experience',
        'heading'  => 'Create an Experience Entry',
        'allTools' => $allTools,
    ]);
})->name('experience.create');

// 3) Handle experience creation
Route::post('/experience', function(Request $request) {
    $data = $request->validate([
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

    $exp = Experience::create($data);
    $exp->tools()->sync($request->input('tools', []));

    return redirect()
        ->route('experience.index')
        ->with('success','Experience added successfully!');
})->name('experience.store');

// 4) Show a single experience
Route::get('/experience/{slug}', function(string $slug) {
    $exp = Experience::with(['skills','achievements','tools'])
                     ->where('slug',$slug)
                     ->firstOrFail();

    return view('experience.show', [
        'title'   => $exp->title,
        'heading' => "{$exp->company} • {$exp->period}",
        'exp'     => $exp,
    ]);
})->name('experience.show');
