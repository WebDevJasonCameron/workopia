<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1> hello </h1>';
});

Rout::post('/submit', function () {
    return 'Submitted';
});
