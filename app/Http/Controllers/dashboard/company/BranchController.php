<?php

namespace App\Http\Controllers\dashboard\company;

use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:company_manager");
        $this->middleware("company_has_branch")->only(["edit", "update", "destroy","show"]);
    }

    public function index()
    {
        $company = myCompany();
        $page = "إدارة الفروع";
        session()->put("c_page", "branches_management");

        return view("dashboard.company.branches.index", compact("page", "company"));

    }

    public function create()
    {
        $page = "إضافة فرع";
        session()->put("c_page", "branches_management");
        return view("dashboard.company.branches.add", compact("page"));
    }

    public function store()
    {
        Branch::create_branch();
        return redirect("dashboard/branches")->with("success", "تمت إضافة الفرع بنجاح");
    }

    public function show(Branch $branch)
    {
        $page = $branch->name;
        session()->put("c_page", "branches_management");
        session()->put("hash", session("hash") ?? "generalInfo");
        return view("dashboard.company.branches.show", compact("branch","page"));
    }

    public function edit(Branch $branch)
    {
        $page = "تعديل - " . $branch->name;
        session()->put("c_page", "branches_management");
        return view("dashboard.company.branches.edit", compact("branch", "page"));
    }

    public function update(Branch $branch)
    {
        Branch::update_branch($branch);
        return redirect("dashboard/branches")->with("success", "تم تعديل الفرع بنجاح");

    }

    public function destroy(Branch $branch)
    {
        \DB::beginTransaction();

        try {
            $branch->delete();
            $branch->user->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/branches/")->with("success", "تم حذف الفرع بنجاح");
    }
}
