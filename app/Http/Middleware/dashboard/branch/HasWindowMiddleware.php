<?php

namespace App\Http\Middleware\dashboard\branch;

use Closure;

class HasWindowMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $branch = myBranch();
        $window = $branch->windows()->find(request("window")->id);

        if (is_null($window)) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
