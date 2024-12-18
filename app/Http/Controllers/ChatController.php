<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index(): Response
    {
        $data = $this->chatService->getChats();
        
        return Inertia::render('Chat/ShowChats', [
            'chats' => $data['chats'],
            'user' => $data['user'],
        ]);
    }

    public function send(Request $request)
    {
        return $this->chatService->sendMessage($request);
    }
}
