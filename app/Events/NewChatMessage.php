<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;
    public User $user;

    public function __construct(Message $message)
    {
        $user = Auth::user();

        $createdMessage = Message::create([
            'user_id' => $user->id,
            'chat_id' => $message->chat_id,
            'content' => $message->content,
            'send_at' => now(),
        ]);

        $this->message = $createdMessage;
        $this->user = $user;
        Log::info(['message' => $this->message, 'user' => $this->user]);
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'content' => $this->message->content,
                'user' => [
                    'name' => $this->user->name,
                    'id' => $this->user->id
                ],
            ],
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('new-chat-message.' . $this->message->chat_id),
        ];
    }
}