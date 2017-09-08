<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmins
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$user = auth()->user()) {
            return redirect()->route('login');
        } elseif (!$user->isAdmin()) {
            abort(404);
        }

        return $next($request);
    }
}
