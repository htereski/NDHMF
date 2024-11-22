<?php

use App\Events\NewChatMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $user = Auth::user();

    if (isset($user)) {
        $user = true;
    } else {
        $user = false;
    }

    return Inertia::render('Index', [
        'user' => $user,
    ]);
})->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/chats', function () {

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $chats = $user->chats()
            ->with('messages.user')
            ->get();

        return Inertia::render('Chat/ShowChats', [
            'chats' => $chats
        ]);
    })->name('chats');

    Route::post('/send/message', function (Request $request) {

        $request->validate([
            'chat_id' => ['required', 'exists:chats,id'],
            'content' => ['required', 'max:255'],
        ]);

        $message = new Message();
        $message->chat_id = $request->chat_id;
        $message->content = $request->content;
        
        event(new NewChatMessage($message));

    })->name('send.message');
});