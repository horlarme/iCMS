<?php

namespace App\Http\Middleware;

use Closure;

class Restriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strtolower(userRole(getUser('id'))) != 'administrator') {
            return response()
                ->make('You do not have access to perform this task!', 403);
        }
        return $next($request);
    }
}
