<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\User;
use App\Utils\AuthUtils;
use Inertia\Inertia;
use Inertia\Response;

class HomeService
{
    public function principal(): Response
    {
        $user = AuthUtils::loggedUser();
        $loggedIn = false;
        $chat = null;

        if ($user) {
            $user->load(['role', 'chats.messages.user']);

            if ($user->role && $user->role->name == 'vitima') {
                $chat = $user->chats->first();

                $usersMembers = User::whereHas('role', function ($query) {
                    $query->whereIn('name', ['admin', 'marielle']);
                })->get();

                if (!$chat) {
                    $chat = $this->createChatForUser($user, $usersMembers);
                }
            }

            $loggedIn = true;
        }

        return Inertia::render('Index', [
            'loggedIn' => $loggedIn,
            'chat' => $chat,
            'user' => $user,
        ]);
    }

    private function createChatForUser(User $user, $usersMembers)
    {
        $chat = Chat::create();
        $user->chats()->attach($chat->id);

        foreach ($usersMembers as $member) {
            $member->chats()->attach($chat->id);
        }

        return $chat;
    }
}