<?php

namespace App\Http\Middleware;

use Closure;

class PrivilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$privilege)
    {

        if ($privilege) {

            if (!auth()->user()->has_priv($privilege)) {
                return redirect("dashboard/home")->with("error", __("dashboard.access_denied"));
            }

            session()->put("c_page", $privilege[0]);
        }

        return $next($request);
    }
}
