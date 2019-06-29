<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("has_role:branch_manager");
        $this->middleware("branch_has_employee")->only(["edit", "update", "destroy", "show"]);
    }

    public function index()
    {
        $page = "إدارة الموظفين";
        session()->put("c_page", "employees_management");

        $employees = myBranch()->employees;
        return view("dashboard.branch.employees.index", compact("employees", "page"));
    }

    public function create()
    {
        $branch = myBranch();
        $page = "إضافة موظف";
        session()->put("c_page", "employees_management");

        return view('dashboard.branch.employees.add', compact("branch", "page"));
    }

    public function store()
    {
        Employee::store_employee();
        return redirect("dashboard/employees")->with("success", "تمت إضافة الموظف بنجاح");
    }

    public function show($id)
    {
        //
    }

    public function edit(Employee $employee)
    {
        $page = "تعديل - " . $employee->user->name;
        session()->put("c_page", "employees_management");

        return view('dashboard.branch.employees.edit', compact('employee','page'));
    }

    public function update(Employee $employee)
    {

        Employee::update_employee($employee);

        return redirect("dashboard/employees")->with("success", "تم تعديل الموظف بنجاح");

    }

    public function destroy(Employee $employee)
    {
        \DB::beginTransaction();

        try {
            $user = $employee->user;
            $employee->services()->detach();
            $employee->delete();
            $user->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect("dashboard/employees")->with("success", "تم حذف الموظف بنجاح");
    }
}
