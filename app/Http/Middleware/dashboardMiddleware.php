<?php

namespace App\Http\Middleware;

use Closure;

class dashboardMiddleware
{

    public function handle($request, Closure $next, $privilege = null)
    {

        if (!auth()->check()) {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }

        if (auth()->user()->type == "user") {
            return redirect("dashboard/login")->with("error", __("dashboard.access_denied"));
        }

        if ($privilege) {

            if (!login_user()->has_priv($privilege)) {
                return redirect("dashboard/home")->with("error", __("dashboard.access_denied"));
            }

            session()->put("c_page", $privilege);
        }

        return $next($request);
    }
}
