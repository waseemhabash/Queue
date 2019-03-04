<?php

Route::prefix("dashboard")->middleware("dashboard")->group(function () {

    Route::get('/home', "dashboard\HomeController@index");

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

    Route::resource("companies", "dashboard\CompanyController")->middleware("privilege:companies_management");

    /**
     * Branches
     */

    Route::middleware(["privilege:branches_management,branch", "branch"])->group(function () {

        Route::get("companies/{company_id}/branches/create", "dashboard\BranchController@create");
        Route::post("companies/{company_id?}/branches", "dashboard\BranchController@store");

        Route::resource("companies/branches", "dashboard\BranchController")->except(["index", "create", "store"]);

    });
    /**
     * Services
     */

    Route::resource("services", "dashboard\ServiceController");

    /**
     * Store Tap Id In Session
     */
    Route::post('/tap', "dashboard\CompanyController@storeTapId");
});

Route::prefix("dashboard")->group(function () {

    Route::get("/change_hash_tab/{hash}", function ($hash) {
        session()->put("hash", $hash);
    });

    Route::get('/logout', "dashboard\UserController@logout");

    Route::any('/login', "dashboard\UserController@login");

});
