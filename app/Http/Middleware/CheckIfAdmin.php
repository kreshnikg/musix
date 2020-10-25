<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
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
        $user = User::with('role')->findOrFail(Auth::id());
        if($user->role->title == 'admin' || $user->role->title == "manager")
            return $next($request);
        else
            return abort(404);
    }
}
