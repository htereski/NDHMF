<?php

namespace App\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthUtils
{
    public static function loggedUser(): ?User
    {
        /** @var User|null $user **/
        return Auth::user();
    }
}