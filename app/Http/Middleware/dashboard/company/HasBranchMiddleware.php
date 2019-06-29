<?php

namespace App\Http\Middleware\dashboard\company;

use Closure;

class HasBranchMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $company = myCompany();
        $branch = $company->branches()->find(request("branch")->id);
        
        if (is_null($branch)) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
