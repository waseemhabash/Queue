<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;

class BranchMiddleware
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

        $company_id = request("company_id") ?? request("branch")->company->id ?? 0;
        $company = Company::findOrFail($company_id);

        $can_access = (auth()->user()->type == "admin");
        $can_access = $can_access || (auth()->user()->type == "company_manager" && auth()->user()->company->id == $company->id);
        $can_access = $can_access || (auth()->user()->type == "branch_manager" && auth()->user()->branch->company->id == $company->id);

        if (!$can_access) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }

        return $next($request);
    }
}
