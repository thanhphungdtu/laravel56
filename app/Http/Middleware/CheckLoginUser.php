<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/23/2019
 * Time: 4:50 PM
 */

namespace App\Http\Middleware;
use Closure;

class CheckLoginUser
{
    public function  handle($request, Closure $next){
        if(!get_data_user('web'))
        {
            return redirect()->route('get.login');
        }
        return $next($request);
    }
}