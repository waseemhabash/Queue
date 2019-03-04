<?php

namespace App\Http\Middleware;

use Closure;

class dashboardMiddleware
{

    public function handle($request, Closure $next)
    {

        if (!auth()->check()) {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }

        if (auth()->user()->type == "user") {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }

        

        return $next($request);
    }
}
