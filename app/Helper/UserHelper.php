<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function authenticated(): ?User
    {
        /** @var User|null $user **/
        $user = Auth::user();
        
        return $user;
    }
}
