<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware("c_page:services_management");
        $this->middleware("branchPart:service");
    }

    public function create($branch_id)
    {
        return view('dashboard.services.add', compact("branch_id"));
    }

    public function store($branch_id)
    {

        Service::store_service($branch_id);

        return redirect("dashboard/companies/branches/$branch_id")->with("success", __("dashboard.added_successfully"));

    }

    public function show($id)
    {
        //
    }

    public function edit(Service $service)
    {

        return view('dashboard.services.edit', compact('service'));
    }

    public function update(Service $service)
    {
        Service::update_service($service);

        return redirect("dashboard/companies/branches/$service->branch_id")->with("success", __("dashboard.updated_successfully"));
    }

    public function destroy(Service $service)
    {
        \DB::beginTransaction();

        try {
            $service->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/companies/branches/$service->branch_id")->with("success", __("dashboard.deleted_successfully"));
    }
}
