<?php

namespace App\Http\Controllers\dashboard\branch;

use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware("has_role:branch_manager");
    }

    public function index()
    {
        $branch = myBranch();
        $page = $branch->name;
        session()->put("c_page", "branches_management");
        session()->put("hash", session("hash") ?? "generalInfo");

        return view("dashboard.branch.index", compact("branch", "page"));
    }
}
