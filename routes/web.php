<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('Home');

Route::get('/account', function () {
    return Inertia::render('Account');
})->name('Account');

Route::get('/explore', function () {
    return Inertia::render('Explore');
})->name('Explore');

Route::get('/messages', function () {
    return Inertia::render('Messages');
})->name('Messages');