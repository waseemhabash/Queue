<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("c_page:employees_management");
        $this->middleware("branchPart:employee");
    }

    public function create($branch_id)
    {
        $branch = Branch::with("services")->find($branch_id);
        return view('dashboard.employees.add', compact("branch"));
    }

    public function store($branch_id)
    {

        Employee::store_employee($branch_id);

        return redirect("dashboard/companies/branches/$branch_id")->with("success", __("dashboard.added_successfully"));

    }

    public function show($id)
    {
        //
    }

    public function edit(Employee $employee)
    {

        return view('dashboard.employees.edit', compact('employee'));
    }

    public function update(Employee $employee)
    {

        Employee::update_employee($employee);

        return redirect("dashboard/companies/branches/$employee->branch_id")->with("success", __("dashboard.updated_successfully"));

    }

    public function destroy(Employee $employee)
    {
        \DB::beginTransaction();

        try {
            $employee->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/companies/branches/$employee->branch_id")->with("success", __("dashboard.deleted_successfully"));
    }
}
