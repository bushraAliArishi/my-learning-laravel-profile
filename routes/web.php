<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExperienceController;

// ───────────────────────────────────────────────── Static Pages ──────
Route::view('/',        'home',    ['title'=>'Home','heading'=>'Welcome'])->name('home');
Route::view('/about',   'about',   ['title'=>'About Us','heading'=>'Learn More'])->name('about');
Route::view('/contact', 'contact', ['title'=>'Contact','heading'=>'Get in Touch'])->name('contact');

// ─────────────────────────────────────────────────────────────── Tags & Tools ──────
Route::post('/tags',  [TagController::class,  'store'])->name('tags.store');
Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');

// ──────────────────────────────────────────────────────────── Projects ──────
Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index')->name('projects.index');
    Route::get('/projects/create', 'create')->name('projects.create');
    Route::post('/projects', 'store')->name('projects.store');
    Route::get('/projects/{project}/edit', 'edit')->name('projects.edit');
    Route::patch('/projects/{project}', 'update')->name('projects.update');
    Route::delete('/projects/{project}', 'destroy')->name('projects.destroy');
});
 
// ─────────────────────────────────────────────────────────── Experience ──────
Route::resource('experience', ExperienceController::class);   
// Route::get   ('/experience',                   [ExperienceController::class, 'index'])   ->name('experience.index');
// Route::get   ('/experience/create',            [ExperienceController::class, 'create'])  ->name('experience.create');
// Route::post  ('/experience',                   [ExperienceController::class, 'store'])   ->name('experience.store');
// Route::get   ('/experience/{experience}/edit', [ExperienceController::class, 'edit'])    ->name('experience.edit');
// Route::patch ('/experience/{experience}',      [ExperienceController::class, 'update'])  ->name('experience.update');
// Route::delete('/experience/{experience}',      [ExperienceController::class, 'destroy']) ->name('experience.destroy');
// Route::get   ('/experience/{experience}',      [ExperienceController::class, 'show'])    ->name('experience.show');
