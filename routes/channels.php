<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('new-chat-message.{chatId}', function ($user, $chatId) {
    return $user->chats()->where('chat_id', $chatId)->exists();
});