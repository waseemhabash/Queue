<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;
use App\Models\Window;

class WindowController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:branch_manager");
        $this->middleware("branch_has_window")->only(["edit", "update", "destroy", "show"]);
    }

    public function index()
    {
        $page = "إدارة الشبابيك";
        session()->put("c_page", "windows_management");

        $windows = myBranch()->windows;
        return view("dashboard.branch.windows.index", compact("windows", "page"));
    }

    public function create()
    {
        $page = "إضافة شباك";
        session()->put("c_page", "windows_management");

        return view('dashboard.branch.windows.add', compact("page"));
    }

    public function store()
    {
        Window::store_window();

        return redirect("dashboard/windows")->with("success", "تمت إضافةالشباك بنجاح");

    }

    public function show($id)
    {
        //
    }

    public function edit(Window $window)
    {
        $page = "تعديل الشباك";
        session()->put("c_page", "windows_management");

        return view('dashboard.branch.windows.edit', compact('window', 'page'));
    }

    public function update(Window $window)
    {
        Window::update_window($window);
        return redirect("dashboard/windows")->with("success", "تم تعديل الشباك بنجاح");
    }

    public function destroy(Window $window)
    {
        \DB::beginTransaction();

        try {
            $window->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/windows")->with("success", "تم حذف الشباك بنجاح");
    }
}
