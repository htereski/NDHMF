<?php

namespace App\Http\Middleware;

use App\Helper\UserHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationMemberOnly
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = UserHelper::authenticated();

        if($user->role->name == 'vitima') {
            return redirect()->route('index');
        }

        return $next($request);
    }
}