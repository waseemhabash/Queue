<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Service;

class ServiceController extends Controller
{
    public function get_services()
    {

        if (request("service_id")) {
            validate([
                "service_id" => "required|exists:services,id",
            ]) ?? exit;

            $service = Service::find(request("service_id"));

            res([
                "service" => $service,
            ]);
            exit;
        }

        validate([
            "branch_id" => "required|exists:branches,id",
        ]) ?? exit;

        $branch = Branch::find(request("branch_id"));
        $services = $branch->services()->paginate(10);

        res([
            "services" => $services,
        ]);
        exit;
    }

}
