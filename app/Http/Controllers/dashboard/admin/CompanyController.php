<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:admin");
    }

    public function index()
    {
        $page = "إدارة الشركات";
        session()->put("c_page", "companies_management");

        $companies = Company::with(["user"])->get();

        return view('dashboard.admin.companies.index', compact('companies', 'page'));
    }

    public function create()
    {
        $page = "إضافة شركة";
        session()->put("c_page", "companies_management");

        return view('dashboard.admin.companies.add', compact('page'));
    }

    public function store()
    {
        Company::create_company();
        return redirect('dashboard/companies')->with("success", __("dashboard.added_successfully"));
    }

    public function show(Company $company)
    {
        $page = $company->name;
        session()->put("c_page", "companies_management");
        session()->put("hash", session("hash") ?? "generalInfo");

        return view("dashboard.admin.companies.show", compact("company", "page"));
    }

    public function edit(Company $company)
    {
        $page = "تعديل - " . $company->name;
        session()->put("c_page", "companies_management");
        return view('dashboard.admin.companies.edit', compact('company',"page"));
    }

    public function update(Company $company)
    {
        Company::update_company($company);

        return redirect('dashboard/companies')->with("success", __("dashboard.updated_successfully"));
    }

    public function destroy(Company $company)
    {
        \DB::beginTransaction();

        try {
            $company->delete();
            $company->user->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect('dashboard/companies')->with("success", __("dashboard.deleted_successfully"));
    }
}
