<?php

namespace App\Http\Middleware\dashboard\branch;

use Closure;
use App\Models\TicketsEmployee;
class HasTicketsEmployeeMiddleware
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
        $tickets_employee = $branch->tickets_employees()->find(request("tickets_employee"));

        if (is_null($tickets_employee)) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }

        return $next($request);
    }
}
