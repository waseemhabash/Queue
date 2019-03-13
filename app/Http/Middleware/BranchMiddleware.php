<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;

class BranchMiddleware
{

    public function handle($request, Closure $next)
    {

        $company_id = request("company_id") ?? request("branch")->company->id ?? 0;
        $company = Company::findOrFail($company_id);

        $can_access = is_type("admin");
        $can_access = $can_access || (is_type("company_manager") && auth()->user()->company->id == $company_id);
        $can_access = $can_access || (is_type("branch_manager") && auth()->user()->branch->company->id == $company_id);

        if (!$can_access) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }

        return $next($request);
    }
}
