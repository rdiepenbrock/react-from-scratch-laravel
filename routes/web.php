<?php

use App\Http\Controllers\PuppyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PuppyController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('puppies/{puppy}/like', [PuppyController::class, 'like'])->name('puppies.like');
    Route::post('puppies.store', [PuppyController::class, 'store'])->name('puppies.store');
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
