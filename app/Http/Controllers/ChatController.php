<?php

namespace App\Http\Controllers;

use App\Exceptions\ChatNotFoundException;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index(): Response
    {
        $data = $this->chatService->getChats();

        return Inertia::render('Chat/Show', [
            'chats' => $data['chats'],
            'user' => $data['user'],
        ]);
    }

    public function getMessages(int $id): JsonResponse
    {
        $data = $this->chatService->getMessages($id);

        return response()->json([
            'messages' => $data['messages']
        ]);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $data = $this->chatService->show($id);
            return response()->json($data, 200);
        } catch (ChatNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno no servidor.'], 500);
        }
    }

    public function send(Request $request)
    {
        return $this->chatService->sendMessage($request);
    }
}
