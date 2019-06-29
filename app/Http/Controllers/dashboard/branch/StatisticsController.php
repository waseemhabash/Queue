<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function mostOrderedService()
    {
        $branch = myBranch();
        return response()->json([
            "services" => $branch->services->map(function ($service) {
                return [
                    "name" => $service->name,
                    "order_count" => $service->queues->count(),
                ];
            }),
        ]);
    }

    public function CustomerServiced()
    {
        
        $branch = myBranch();
        return response()->json([
            "employees" => $branch->employees->map(function ($employee) {
                return [
                    "name" => $employee->user->name,
                    "customers" => $employee->queue->count(),
                ];
            }),
        ]);
    }

    public function customerRated()
    {
        $branch = myBranch();
        return response()->json([
            "employees" => $branch->employees->map(function ($employee) {
                return [
                    "name" => $employee->user->name,
                    "rate" => number_format($employee->rate_avg(),2),
                ];
            }),
        ]);  
    }

    public function avgTimeService()
    {
        $branch = myBranch();
        return response()->json([
            "employees" => $branch->services->map(function ($service) {
                return [
                    "name" => $service->name,
                    "time" => round($service->avg_time()),
                    "real_time" => $service->time
                ];
            }),
        ]);
    }

    
}
