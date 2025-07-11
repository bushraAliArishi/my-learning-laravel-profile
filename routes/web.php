<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tool;
use App\Models\Tag;
use App\Models\ExperienceSkill;
use App\Models\ExperienceAchievement;
use App\Models\ProjectMedia;
use App\Models\Experience;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectMedia as Media;
use App\Models\ProjectTool as ToolPivot;
use App\Models\ProjectTag as TagPivot;
use App\Models\ProjectTool;


Route::get('/', function () {
    return view('home', [
        'title'   => 'Home',
        'heading' => 'Welcome to Our Learning App',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title'   => 'About Us',
        'heading' => 'Learn More About Us',
    ]);
});

Route::get('/about-us', function () {
    return view('about-us', [
        'title'   => 'About Me',
        'heading' => 'Learn More About Me',
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title'   => 'Contact Us',
        'heading' => 'Get in Touch',
    ]);
});


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
        $query->whereHas('tags', function($q) use($tags) {
            $q->whereIn('tags.id', $tags);
        });
    }

    if ($tools = $request->input('tools', [])) {
        $query->whereHas('tools', function($q) use($tools) {
            $q->whereIn('tools.id', $tools);
        });
    }

    $projects = $query->orderBy('created_at','desc')
                      ->paginate(9)
                      ->withQueryString();

    return view('projects', compact('projects','allTags','allTools'));
});


Route::get('/experience', function () {

    $experiences = Experience::with(['skills', 'achievements', 'tools'])
                             ->orderBy('start_date', 'desc')
                             ->get();

    return view('experience.index', [
        'title'       => 'All Experience',
        'heading'     => 'Learn More About Me',
        'experiences' => $experiences,     
        
    ]);
});


Route::get('/experience/{slug}', function (string $slug) {
    $exp = Experience::with(['skills', 'achievements', 'tools'])
                     ->where('slug', $slug)
                     ->firstOrFail();

    return view('experience.show', [
        'title'   => $exp->title,
        'heading' => "{$exp->company} • {$exp->period}",
        'exp'     => $exp,                

    ]);
});