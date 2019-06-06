<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\TicketsEmployee;

class TicketsEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("c_page:ticketsEmployees_management");
        $this->middleware("branchPart:ticketsEmployee");
    }

    public function create($branch_id)
    {
        $branch = Branch::with("services")->find($branch_id);
        return view('dashboard.tickets_employees.add', compact("branch"));
    }

    public function store($branch_id)
    {

        TicketsEmployee::store_employee($branch_id);

        return redirect("dashboard/companies/branches/$branch_id")->with("success", __("dashboard.added_successfully"));

    }

    public function show($id)
    {
        //
    }

    public function edit($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);
        return view('dashboard.tickets_employees.edit', compact('employee'));
    }

    public function update($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);
        TicketsEmployee::update_employee($employee);

        return redirect("dashboard/companies/branches/$employee->branch_id")->with("success", __("dashboard.updated_successfully"));

    }

    public function destroy($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);

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
