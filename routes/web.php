<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/about-us', function () {
    return view('about-us');
});
Route::get('/contact', function () {
    return view('contact');
});

