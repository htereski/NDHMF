<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrganizationMemberOnly
{

    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user **/
        $user = Auth::user();

        $user->load('role');
        
        if($user->role->name == 'vitima') {
            return redirect()->route('index');
        }

        return $next($request);
    }
}