<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    // protected function unauthenticated($request, array $guards)
    // {
    //     if ($request->expectsJson() || $request->is('api/*')) {
    //         throw new AuthenticationException(
    //             'Unauthenticated.', $guards, $this->redirectTo($request)
    //         );
    //     }

    //     redirect()->guest(route('login'));
    // }
}
