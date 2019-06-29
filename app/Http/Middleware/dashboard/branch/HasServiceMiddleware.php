<?php

namespace App\Http\Middleware\dashboard\branch;

use Closure;

class HasServiceMiddleware
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
        $service = $branch->services()->find(request("service")->id);

        if (is_null($service)) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
