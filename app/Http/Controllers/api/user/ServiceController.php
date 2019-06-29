<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Rate;
use App\Models\Service;

class ServiceController extends Controller
{
    public function get_services()
    {
        if (request("service_id")) {
            validate([
                "service_id" => "required|exists:services,id",
            ]) ?? exit;

            $service = Service::with("images")->find(request("service_id"));

            res([
                "service" => $service,
            ]);
            exit;
        }

        validate([
            "branch_id" => "required|exists:branches,id",
        ]) ?? exit;

        $branch = Branch::find(request("branch_id"));
        $services = $branch->services()->with("images")->paginate(10);
        res([
            "services" => $services,
        ]);
        exit;
    }

    public function rate()
    {
        $user = userFromToken();

        validate([
            "queue_id" => "required|exists:queues,id",
            "rate" => "required|integer|between:1,5",
        ]) ?? exit;

        $rate = Rate::updateOrCreate([
            "queue_id" => request("queue_id"),
            "rate" => request("rate"),
        ]);

        res();
        exit;

    }

}
