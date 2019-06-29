<?php

namespace App\Http\Controllers\dashboard\company;

use App\Http\Controllers\Controller;
use App\Models\Queue;

class StatisticsController extends Controller
{
    public function customerBranchStatistic()
    {
        $company = myCompany();
        return response()->json([
            "branches" => $company->branches->map(function ($branch) {
                return [
                    "name" => $branch->name,
                    "customers" => Queue::whereHas("service", function ($service) use ($branch) {
                        $service->where("branch_id", $branch->id);
                    })->count(),
                ];
            }),
        ]);
    }

    public function customerBranchPieStatistic()
    {
        $company = myCompany();
        $all_customers = $company->all_customers();

        return response()->json([
            "branches" => $company->branches->map(function ($branch) use ($all_customers) {
                return [
                    "name" => $branch->name,
                    "customers" => Queue::whereHas("service", function ($service) use ($branch) {
                        $service->where("branch_id", $branch->id);
                    })->count() / ($all_customers->count() +0.0000001),
                ];
            }),
        ]);
    }

    public function rateBranchStatistic()
    {
        $company = myCompany();
        return response()->json([
            "branches" => $company->branches->map(function ($branch) {
                return [
                    "name" => $branch->name,
                    "rate" => number_format($branch->rate_avg(),2),
                ];
            }),
        ]);
    }
}
