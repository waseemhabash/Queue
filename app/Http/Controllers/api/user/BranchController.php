<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Company;

class BranchController extends Controller
{
    public function get_branches()
    {
        validate([
            "lat" => "numeric",
            "lng" => "numeric",
            "company_id" => "required|exists:companies,id",
        ]) ?? exit;

        $company = Company::find(request("company_id"));
        $lng = request("lng");
        $lat = request("lat");
        $branches = $company
            ->branches()
            ->orderBy(\DB::raw(order_by_distance($lat, $lng)))
            ->paginate(10);

        res([
            "branches" => $branches,
        ]);

        exit;
    }
}
