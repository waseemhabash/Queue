<?php

namespace App\Http\Middleware\dashboard\branch;

use Closure;

class HasEmployeeMiddleware
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
        $employee = $branch->employees()->find(request("employee")->id);

        if (is_null($employee)) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
