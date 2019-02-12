<?php

namespace App\Http\Middleware;

use Closure;

class dashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$privilege = null)
    {

        if($privilege)
        {
            session()->put("c_page",$privilege);
        }

        return $next($request);
    }
}
