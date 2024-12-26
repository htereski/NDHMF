<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;
    public User $user;

    public function __construct(Message $createdMessage, User $user)
    {
        $this->message = $createdMessage;
        $this->user = $user;
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'content' => $this->message->content,
                'send_at' => $this->message->send_at,
                'user' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'role' => $this->user->role
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