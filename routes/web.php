<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use App\Models\Experience;
use App\Models\Project;

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
});// /projects — قائمة المشاريع
Route::get('/projects', function () {
    // eager-load للعلاقات media, tags, tools اللي سويناها في Seeder والموديل
    $projects = Project::with(['media', 'tags', 'tools'])->get();

    return view('projects', [
        'title'    => 'Projects',
        'heading'  => 'My Projects',
        'projects' => $projects,
    ]);
});

// قائمة الخبرات
Route::get('/experience', function () {
    // eager-load للعلاقات skills, achievements, tools
    $experiences = Experience::with(['skills', 'achievements', 'tools'])
                             ->orderBy('start_date', 'desc')  // اذا عندك هذا الحقل
                             ->get();

    return view('experience.index', [
        'title'       => 'All Experience',
        'heading'     => 'Learn More About Me',
        'experiences' => $experiences,      // ← نقول experiences
    ]);
});

// تفاصيل خبرة واحدة
Route::get('/experience/{slug}', function (string $slug) {
    $exp = Experience::with(['skills', 'achievements', 'tools'])
                     ->where('slug', $slug)
                     ->firstOrFail();

    return view('experience.show', [
        'title'   => $exp->title,
        'heading' => "{$exp->company} • {$exp->period}",
        'exp'     => $exp,                   // ← نناديه exp
    ]);
});