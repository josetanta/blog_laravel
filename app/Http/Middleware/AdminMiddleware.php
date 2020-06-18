<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // usuario actualemente navegando en la webapp
        // current_user
        $user = Auth::user();

        if (!empty($user) && $user->is_admin()){
            // collback (before)
            return $next($request);
        }
        else{
            return back(302);
        }
    }
}
