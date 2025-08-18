<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('testmath');
});
