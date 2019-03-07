<?php

Route::prefix("dashboard")->middleware("dashboard")->group(function () {

    Route::get('/', "dashboard\HomeController@index");

    /**
     * Admins
     */

    Route::resource("admins", "dashboard\AdminController")->middleware("privilege:admin_management");

    /**
     * Roles
     */

    Route::resource("roles", "dashboard\RoleController")->middleware("privilege:role_management");

    /**
     * constants
     */

    Route::resource("constants", "dashboard\ConstantController")->middleware("privilege:constant_management");
    /*
     * Companies
     */

    Route::resource("companies", "dashboard\CompanyController")->middleware("privilege:companies_management,company_management");

    /**
     * Branches
     */

    Route::middleware(["privilege:branches_management,branch_management", "branch"])->group(function () {
        Route::get("companies/{company_id}/branches/create", "dashboard\BranchController@create");
        Route::post("companies/{company_id}/branches", "dashboard\BranchController@store");
        Route::resource("companies/branches", "dashboard\BranchController")->except(["index", "create", "store"]);
    });

    /**
     * Services
     */

    Route::middleware(["privilege:services_management", "branchPart:service"])->group(function () {
        Route::get("branches/{branch_id}/services/create", "dashboard\ServiceController@create");
        Route::post("branches/{branch_id}/services", "dashboard\ServiceController@store");
        Route::resource("branches/services", "dashboard\ServiceController")->except(["index", "create", "store"]);
    });

    /**
     * windows
     */

    Route::middleware(["privilege:windows_management", "branchPart:window"])->group(function () {
        Route::get("branches/{branch_id}/windows/create", "dashboard\WindowController@create");
        Route::post("branches/{branch_id}/windows", "dashboard\WindowController@store");
        Route::resource("branches/windows", "dashboard\WindowController")->except(["index", "create", "store"]);
    });

    /**
     * windows
     */

    Route::middleware(["privilege:employees_management", "branchPart:employee"])->group(function () {
        Route::get("branches/{branch_id}/employees/create", "dashboard\EmployeeController@create");
        Route::post("branches/{branch_id}/employees", "dashboard\EmployeeController@store");
        Route::resource("branches/employees", "dashboard\EmployeeController")->except(["index", "create", "store"]);
    });

});

Route::prefix("dashboard")->group(function () {

    Route::get("/change_hash_tab/{hash}", function ($hash) {
        session()->put("hash", $hash);
    });

    Route::get('/logout', "dashboard\UserController@logout");

    Route::any('/login', "dashboard\UserController@login");

});
