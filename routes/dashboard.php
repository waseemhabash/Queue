<?php

Route::prefix("dashboard")->middleware("dashboard")->namespace("dashboard")->group(function () {

    Route::get('/', "HomeController@index");

    /**
     * Admins
     */

    Route::resource("admins", "AdminController");

    /**
     * constants
     */

    Route::resource("constants", "ConstantController");
    /*
     * Companies
     */

    Route::resource("companies", "CompanyController");

    /**
     * Branches
     */

    Route::get("companies/{company_id}/branches/create", "BranchController@create");
    Route::post("companies/{company_id}/branches", "BranchController@store");
    Route::resource("companies/branches", "BranchController")->except(["index", "create", "store"]);

    /**
     * Services
     */

    Route::get("branches/{branch_id}/services/create", "ServiceController@create");
    Route::post("branches/{branch_id}/services", "ServiceController@store");
    Route::resource("branches/services", "ServiceController")->except(["index", "create", "store"]);

    /**
     * windows
     */

    Route::get("branches/{branch_id}/windows/create", "WindowController@create");
    Route::post("branches/{branch_id}/windows", "WindowController@store");
    Route::resource("branches/windows", "WindowController")->except(["index", "create", "store"]);

    /**
     * Employees
     */

    Route::get("branches/{branch_id}/employees/create", "EmployeeController@create");
    Route::post("branches/{branch_id}/employees", "EmployeeController@store");
    Route::resource("branches/employees", "EmployeeController")->except(["index", "create", "store"]);

});

Route::prefix("dashboard")->namespace("dashboard")->group(function () {

    Route::get("/change_hash_tab/{hash}", function ($hash) {
        session()->put("hash", $hash);
    });

    Route::get('/logout', "UserController@logout");

    Route::any('/login', "UserController@login");

});
