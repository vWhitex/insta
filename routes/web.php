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

Route::get('/notifications', function () {
    return Inertia::render('Notifications');
})->name('Notifications');

Route::get('/profile', function () {
    return Inertia::render('Profile');
})->name('Profile');

Route::get('/search', function () {
    return Inertia::render('Search');
})->name('Search');

Route::get('/reels', function () {
    return Inertia::render('Reels');
})->name('Reels');

Route::get('/create', function () {
    return Inertia::render('Create');
})->name('Create');
