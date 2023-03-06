<?php

namespace App\Http\Middleware\Routing;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if ( Auth::check() )
        {
            $user = Auth::user();

            if ( $user->user_type != 1 )
            {
                abort(404);
            }
        }    
        return $next($request);
    }
}
