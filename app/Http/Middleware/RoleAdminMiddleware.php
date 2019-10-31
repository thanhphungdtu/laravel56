<?php

namespace App\Http\Middleware;

use Closure;

class RoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $role = get_data_user('admins','role');
        if($role != 1){
            return redirect()->route('admin.errors');
        }
        return $next($request);
    }
}
