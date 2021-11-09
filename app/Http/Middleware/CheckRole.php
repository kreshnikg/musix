<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $roles = explode("|", $roles);
        $user = User::with('role')->findOrFail(Auth::id());
        $hasRole = false;
        foreach ($roles as $role) {
            if($user->role->title === $role) {
                $hasRole = true;
                break;
            }
        }
        if($hasRole)
            return $next($request);
        else
            return abort(404);
    }
}
