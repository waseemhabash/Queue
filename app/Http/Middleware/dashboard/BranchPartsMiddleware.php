<?php

namespace App\Http\Middleware\dashboard;

use App\Models\Branch;
use App\Models\TicketsEmployee;
use Closure;

class BranchPartsMiddleware
{

    public function handle($request, Closure $next, $part)
    {

        $branch_id = request("branch_id") ?? request($part)->branch_id ?? 0;
        if ($part == "ticketsEmployee") {

            $branch_id = TicketsEmployee::findOrFail(request($part))->branch_id;
        }

        $branch = Branch::findOrFail($branch_id);

        $can_access = is_type("admin");

        $can_access = $can_access || (is_type("company_manager") && auth()->user()->company->branches->find($branch->id));

        $can_access = $can_access || (is_type("branch_manager") && auth()->user()->branch->id == $branch->id);

        if (!$can_access) {
            return redirect("dashboard")->with("error", __("dashboard.access_denied"));
        }
        return $next($request);
    }
}
