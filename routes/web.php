<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\OrganizationMemberOnly;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chats', [ChatController::class, 'index'])->middleware(OrganizationMemberOnly::class)->name('chats');

    Route::post('/send/message', [ChatController::class, 'send'])->name('send.message');
});