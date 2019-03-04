<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchController extends Controller
{

    public function index($company_id)
    {

    }

    public function create($company_id)
    {
        return view("dashboard.branches.add", compact("company_id"));
    }

    public function store($company_id)
    {
        Branch::create_branch($company_id);
        return redirect("dashboard/companies/$company_id")->with("success", __("dashboard.added_successfully"));
    }

    public function show()
    {
        //
    }

    public function edit(Branch $branch)
    {
        return view("dashboard.branches.edit", compact("branch"));
    }

    public function update(Branch $branch)
    {
        Branch::update_branch($branch);
        return redirect("dashboard/companies/" . $branch->company->id)->with("success", __("dashboard.updated_successfully"));

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

        return redirect("dashboard/companies/" . $branch->company->id)->with("success", __("dashboard.deleted_successfully"));
    }
}
