<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ShareInertiaDataCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::share(array_filter([
            'auth' => [
                'user' => function () use ($request) {
                    if (!$user = $request->user()) {
                        return;
                    }

                    return $user->only(['name', 'email', 'role']);
                },
            ],
        ]));

        return $next($request);
    }
}
