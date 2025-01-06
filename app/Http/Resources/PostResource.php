<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'imagem' => $this->imagem,
            'created_at' => $this->created_at,
            'user' => [
                'name' => $this->user->name,
                'role' => $this->user->role,
            ],
            'editors' => $this->editors->map(function ($editor) {
                return [
                    'name' => $editor->name,
                    'role' => $editor->role,
                    'created_at' => $editor->pivot->created_at,
                ];
            }),
        ];
    }
}
