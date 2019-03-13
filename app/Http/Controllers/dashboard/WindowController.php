<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Window;

class WindowController extends Controller
{

    public function __construct()
    {
        $this->middleware("c_page:windows_management");
        $this->middleware("branchPart:window");
    }
    
    public function create($branch_id)
    {
        return view('dashboard.windows.add', compact("branch_id"));
    }

    public function store($branch_id)
    {

        Window::store_window($branch_id);

        return redirect("dashboard/companies/branches/$branch_id")->with("success", __("dashboard.added_successfully"));

    }

    public function show($id)
    {
        //
    }

    public function edit(Window $window)
    {

        return view('dashboard.windows.edit', compact('window'));
    }

    public function update(Window $window)
    {

        Window::update_window($window);

        return redirect("dashboard/companies/branches/$window->branch_id")->with("success", __("dashboard.updated_successfully"));

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

        return redirect("dashboard/companies/branches/$window->branch_id")->with("success", __("dashboard.deleted_successfully"));
    }
}
