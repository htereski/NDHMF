<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\User;
use App\Helper\UserHelper;
use Illuminate\Database\Eloquent\Collection;

class HomeService
{
    public function principal(): array
    {
        $user = UserHelper::authenticated();
        $chat = null;

        if (isset($user)) {
            $user->load(['chats.messages.user']);

            if ($user->role == 'VITIMA') {
                $chat = $user->chats->first();

                $usersMembers = User::whereIn('role', ['ADMIN', 'MARIELLE'])->get();

                if (!$chat) {
                    $chat = $this->createChatForUser($user, $usersMembers);
                }
            }
        }

        return array('chat' => $chat);
    }

    private function createChatForUser(User $user, Collection $usersMembers): Chat
    {
        $chat = Chat::create();
        $user->chats()->attach($chat->id);

        foreach ($usersMembers as $member) {
            $member->chats()->attach($chat->id);
        }

        return $chat;
    }
}
