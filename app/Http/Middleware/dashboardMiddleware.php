<?php

namespace App\Http\Middleware;

use Closure;

class dashboardMiddleware
{

    public function handle($request, Closure $next)
    {
        if (!auth()->check() || is_type("user")) {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }


        return $next($request);
    }
}
