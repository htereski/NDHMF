<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomUserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\OrganizationMemberOnly;
use App\Http\Middleware\ShareInertiaDataCustom;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(ShareInertiaDataCustom::class)->get('/', [HomeController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/user/profile', [CustomUserProfileController::class, 'show'])
        ->name('profile.show');

    Route::middleware(OrganizationMemberOnly::class)->group(function () {
        Route::get('/chats', [ChatController::class, 'index'])->name('chats');
        Route::get('/chats/messages/{id}', [ChatController::class, 'getMessages'])->name('chat.messages');
        Route::get('/chats/show/{id}', [ChatController::class, 'show'])->name('chat.show');

        Route::middleware(ShareInertiaDataCustom::class)->group(function () {

            Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
            Route::post('/post', [PostController::class, 'store'])->name('post.store');
            Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
            Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
            Route::delete('/post/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
        });
    });

    Route::post('/send/message', [ChatController::class, 'send'])->name('send.message');
});

Route::middleware(ShareInertiaDataCustom::class)->group(function () {
    Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

    Route::get('/post', [PostController::class, 'index'])->name('post.index');
});
