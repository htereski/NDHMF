<?php

namespace App\Services;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Utils\AuthUtils;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatService
{

    public function getChats(): Response
    {
        $user = AuthUtils::loggedUser();
        $user->load('role');

        $chats = Chat::with('messages.user')->get();

        return Inertia::render('Chat/ShowChats', [
            'chats' => $chats,
            'user' => $user,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => ['required', 'exists:chats,id'],
            'content' => ['required', 'max:255'],
        ]);

        $user = AuthUtils::loggedUser();

        $createdMessage = Message::create([
            'user_id' => $user->id,
            'chat_id' => $request->chat_id,
            'content' => $request->content,
            'send_at' => now(),
        ]);

        event(new NewChatMessage($createdMessage, $user));
    }
}