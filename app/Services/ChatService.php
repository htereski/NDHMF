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

        $chats = Chat::has('messages')->orderBy('unanswered', 'desc')->get();

        return array('chats' => $chats, 'user' => $user);
    }

    public function getMessages(int $id): array
    {
        $chat = Chat::find($id);

        $messages = $chat->messages()->with('user')->get();

        return array('messages' => $messages);
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

        $chat = Chat::find($request->chat_id);

        if ($user->role != 'VITIMA') {
            $chat->unanswered = false;
        } else {
            $chat->unanswered = true;
        }

        $chat->save();

        event(new NewChatMessage($createdMessage, $user));
    }
}
