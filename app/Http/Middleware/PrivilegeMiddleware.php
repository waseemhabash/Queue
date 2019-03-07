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
    public function handle($request, Closure $next, ...$privileges)
    {

        if ($privileges) {

            if (!auth()->user()->has_priv($privileges)) {
                return redirect("dashboard")->with("error", __("dashboard.access_denied"));
            }

            session()->put("c_page", $privileges[0]);
        }

        return $next($request);
    }
}
