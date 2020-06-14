<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure                  $next
     * @return string
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect('/');
    }
}
