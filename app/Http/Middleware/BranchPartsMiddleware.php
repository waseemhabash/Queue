<?php

namespace App\Http\Middleware;

use App\Models\Branch;
use Closure;

class BranchPartsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $part)
    {
        $branch_id = request("branch_id") ?? request($part)->branch_id ?? 0;
        $branch = Branch::findOrFail($branch_id);

        
        $can_access = (auth()->user()->type == "admin");

        $can_access = $can_access || (auth()->user()->type == "company_manager" && auth()->user()->company->branches->find($branch->id));

        $can_access = $can_access || (auth()->user()->type == "branch_manager" && auth()->user()->branch->id == $branch->id);


        if (!$can_access) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }

        return $next($request);
    }
}
