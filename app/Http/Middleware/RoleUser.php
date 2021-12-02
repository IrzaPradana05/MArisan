<?php

namespace App\Http\Middleware;

use Closure;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if($this->checkUserRole($role)) {
            return $next($request);
        }

        return abort(403);
    }

    public function checkUserRole($role)
    {
        if(is_array($role)) {
            if(\in_array(auth()->user()->role, $role)) return true;
        } 

        if(auth()->user()->role == $role) return true;

        return false;
    }
}
