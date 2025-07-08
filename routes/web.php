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
});

Route::get('/projects', function () {
    $allProjects = Project::all();

    return view('projects', [
        'title'    => 'Projects',
        'heading'  => 'My Projects',
        'projects' => $allProjects,
    ]);
});

Route::get('/experience', function () {
    $allExperiences = Experience::all();

    return view('experience.index', [
        'title'       => 'Experience',
        'heading'     => 'Professional Experience',
        'experiences' => $allExperiences,
    ]);
});

Route::get('/experience/{slug}', function (string $slug) {
    $all = Experience::all();

    $experience = collect($all)
        ->first(fn($e) => $e['slug'] === $slug);

    if (! $experience) {
        abort(404);
    }

    return view('experience.show', [
        'title'   => $experience['title'],
        'heading' => $experience['company'].' • '.$experience['period'],
        'exp'     => (object) $experience,
    ]);
});