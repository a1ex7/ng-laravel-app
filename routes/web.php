<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SignedRouteMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Register');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})
    ->middleware('auth')
    ->name('dashboard');

Route::middleware(SignedRouteMiddleware::class)->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::post('links', [LinkController::class, 'update'])->name('links.update');
    Route::delete('links', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::get('games', [GameController::class, 'index'])->name('games.index');
    Route::post('games', [GameController::class, 'create'])->name('games.create');
});

require __DIR__.'/auth.php';
