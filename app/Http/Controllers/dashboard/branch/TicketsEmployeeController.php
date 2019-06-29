<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\TicketsEmployee;

class TicketsEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("has_role:branch_manager");
        $this->middleware("branch_has_ticketsEmployee")->only(["edit", "update", "destroy", "show"]);
    }

    public function index()
    {
        $page = "إدارة موظفي القسائم";
        session()->put("c_page", "ticketsEmployees_management");

        $tickets_employees = myBranch()->tickets_employees;
        return view("dashboard.branch.tickets_employees.index", compact("tickets_employees", "page"));
    }

    public function create()
    {
        $page = "إضافة موظف قسائم";
        session()->put("c_page", "ticketsEmployees_management");

        return view('dashboard.branch.tickets_employees.add',compact("page"));
    }

    public function store()
    {

        TicketsEmployee::store_employee();

        return redirect("dashboard/tickets-employees/")->with("success", __("dashboard.added_successfully"));

    }

    public function show($id)
    {
        //
    }

    public function edit($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);

        $page = "تعديل موظف قسائم";
        session()->put("c_page", "ticketsEmployees_management");

        return view('dashboard.branch.tickets_employees.edit', compact('employee','page'));
    }

    public function update($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);
        TicketsEmployee::update_employee($employee);

        return redirect("dashboard/tickets-employees")->with("success", __("dashboard.updated_successfully"));

    }

    public function destroy($employee_id)
    {
        $employee = TicketsEmployee::findOrFail($employee_id);

        \DB::beginTransaction();

        try {
            $user = $employee->user;
            $employee->delete();
            $user->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/tickets-employees/")->with("success", __("dashboard.deleted_successfully"));
    }
}
