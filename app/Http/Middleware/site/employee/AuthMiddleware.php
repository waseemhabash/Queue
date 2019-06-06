<?php

namespace App\Http\Middleware\site\employee;

use Closure;

class AuthMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !is_type("services_employee")) {
            return redirect("employee/login")->with("error", __("dashboard.access_denied"));
        }

        return $next($request);
    }
}
