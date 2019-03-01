<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;

class BranchController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        if (auth()->user()->type == "admin" && session("company_id")) {
            $company_id = session("company_id");
            Company::findOrFail($company_id);
        } else {
            return redirect("dashboard/home")->with("error", __("dashboard.access_denied"));
        }

        return view("dashboard.branches.add", compact("company_id"));
    }

    public function store()
    {
        Branch::create_branch();
        return redirect("dashboard/companies/" . session("company_id"))->with("success", __("dashboard.added_successfully"));
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
