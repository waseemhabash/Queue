<?php

namespace App\Http\Middleware\dashboard;

use Closure;

class DashboardMiddleware
{
 
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || is_type(["customer","tickets_employee","services_employee"])) {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
