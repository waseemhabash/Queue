<?php

namespace App\Http\Middleware\dashboard;

use Closure;

class RoleMiddleware
{
  
    public function handle($request, Closure $next, ...$types)
    {
        $can_access = is_type("admin") || is_type($types);

        if (!$can_access) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
