<?php

namespace App\Services;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Helper\UserHelper;
use Illuminate\Http\Request;

class ChatService
{

    public function getChats(): array
    {
        $user = UserHelper::authenticated();

        $chats = Chat::with('messages.user')->get();

        return array('chats' => $chats, 'user' => $user);
    }

    public function sendMessage(Request $request): void
    {
        $request->validate([
            'chat_id' => ['required', 'exists:chats,id'],
            'content' => ['required', 'max:255'],
        ]);

        $user = UserHelper::authenticated();

        $createdMessage = Message::create([
            'user_id' => $user->id,
            'chat_id' => $request->chat_id,
            'content' => $request->content,
            'send_at' => now(),
        ]);

        event(new NewChatMessage($createdMessage, $user));
    }
}
