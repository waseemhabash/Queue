<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Service_image;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:branch_manager");
        $this->middleware("branch_has_service")->only(["edit", "update", "destroy", "show"]);
    }

    public function index()
    {
        $page = "إدارة الخدمات";
        session()->put("c_page", "services_management");

        $services = myBranch()->services;
        return view("dashboard.branch.services.index", compact("services", "page"));
    }

    public function create()
    {
        $page = "إضافة خدمة";
        session()->put("c_page", "services_management");

        return view('dashboard.branch.services.add', compact("page"));
    }

    public function store()
    {

        Service::store_service();

        return redirect("dashboard/services")->with("success", "تمت إضافة الخدمة بنجاح");

    }

    public function show($id)
    {
        //
    }

    public function edit(Service $service)
    {
        $page = "تعديل خدمة";
        session()->put("c_page", "services_management");
        return view('dashboard.branch.services.edit', compact('service', 'page'));
    }

    public function update(Service $service)
    {
        Service::update_service($service);

        return redirect("dashboard/services")->with("success", "تم تعديل الخدمة بنجاح");
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

        return redirect("dashboard/services")->with("success", "تم حذف الخدمة بنجاح");
    }

    public function delete_service_image($image_id)
    {
        $image = Service_image::findOrFail($image_id);
        del_file($image->path);
        $image->delete();

        return back()->with("success","تم حذف الصورة بنجاح");
    }
}
