<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OrganizationMemberOnly;
use App\Http\Middleware\ShareInertiaDataCustom;
use Illuminate\Support\Facades\Route;

Route::middleware(ShareInertiaDataCustom::class)->get('/', [HomeController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

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

    Route::middleware(AdminMiddleware::class)->group(function() {
        Route::get('/admin/user', [AdminController::class, 'index'])->name('admin.user');
        Route::get('/admin/user/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/user/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/admin/user/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/user/update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/user/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::post('/send/message', [ChatController::class, 'send'])->name('send.message');
});

Route::middleware(ShareInertiaDataCustom::class)->group(function () {
    Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

    Route::get('/post', [PostController::class, 'index'])->name('post.index');
});
