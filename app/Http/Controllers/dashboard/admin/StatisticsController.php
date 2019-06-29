<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;

class StatisticsController extends Controller
{
    public function adminHomeStatistic()
    {
        return response()->json([
            "companies" => Company::all()->map(function ($company) {
                return [
                    "name" => $company->name,
                    "branches" => $company->branches->count(),
                ];
            }),
        ]);
    }
}
