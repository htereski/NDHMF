<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'content' => $this->content,
            'send_at' => $this->send_at,
            'user' => [
                'name' => $this->user->name,
                'role' => $this->user->role,
            ],

        ];
    }
}
