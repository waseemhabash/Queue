<?php

namespace App\Http\Controllers\dashboard\company;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware("has_role:company_manager");
    }

    public function index()
    {
        $company = myCompany();
        $page = $company->name;
        session()->put("c_page", "companies_management");
        session()->put("hash", session("hash") ?? "generalInfo");

        return view("dashboard.company.index", compact("company", "page"));
    }
}
