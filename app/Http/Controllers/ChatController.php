<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\Request;
use Inertia\Response;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index(): Response
    {
        return $this->chatService->getChats();
    }

    public function send(Request $request)
    {
        return $this->chatService->sendMessage($request);
    }
}