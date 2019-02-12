<?php

namespace App\Http\Middleware;

use Closure;

class dashboardMiddleware
{

    public function handle($request, Closure $next,$privilege = null)
    {

        if(!auth()->check())
        {
            return redirect("dashboard/login")->with("error",__("dashboard.access_denied"));
        }




        if($privilege)
        {
            session()->put("c_page",$privilege);
        }

        return $next($request);
    }
}
