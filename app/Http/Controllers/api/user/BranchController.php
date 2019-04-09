<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Company;

class BranchController extends Controller
{
    public function get_branches()
    {
        validate([
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "company_id" => "required|exists:companies,id",
            "transport" => "required|in:walking,driving",
        ]) ?? exit;

        $company = Company::find(request("company_id"));
        $lng = request("lng");
        $lat = request("lat");
        $branches = $company
            ->branches()
            ->orderBy(\DB::raw("( 6371 * ACOS( COS( RADIANS( '$lat' ) ) * COS( RADIANS( branches.lat ) ) * COS( RADIANS( branches.lng ) - RADIANS( '$lng' ) ) + SIN( RADIANS( '$lat' ) ) * SIN( RADIANS( branches.lat))))"))
            ->paginate(10);

        res([
            "branches" => $branches,
        ]);
        
        exit;
    }
}
