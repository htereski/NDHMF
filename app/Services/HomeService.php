<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\User;
use App\Helper\UserHelper;

class HomeService
{
    public function principal(): array
    {
        $user = UserHelper::authenticated();
        $isAuthenticated = false;
        $chat = null;

        if (isset($user)) {
            $user->load(['chats.messages.user']);

            if ($user->role->name == 'vitima') {
                $chat = $user->chats->first();

                $usersMembers = User::whereHas('role', function ($query) {
                    $query->whereIn('name', ['admin', 'marielle']);
                })->get();

                if (!$chat) {
                    $chat = $this->createChatForUser($user, $usersMembers);
                }
            }

            $isAuthenticated = true;
        }

        return array('isAuthenticated' => $isAuthenticated, 'chat' => $chat, 'user' => $user);
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
