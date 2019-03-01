<?php

Route::prefix("dashboard")->middleware("dashboardMiddleware")->group(function () {

    Route::get('/home', "dashboard\HomeController@index");

    /**
     * Admins
     */

    Route::resource("admins", "dashboard\AdminController")->middleware("dashboardMiddleware:admin_management");

    /**
     * Roles
     */

    Route::resource("roles", "dashboard\RoleController")->middleware("dashboardMiddleware:role_management");

    /**
     * constants
     */

    Route::resource("constants", "dashboard\ConstantController")->middleware("dashboardMiddleware:constant_management");
    /*
     * Companies
     */

    Route::resource("companies", "dashboard\CompanyController")->middleware("dashboardMiddleware:companies_management");

    /**
     * Branches
     */

    Route::resource("branches", "dashboard\BranchController")->middleware("dashboardMiddleware:branches_management");

    /**
     * Services
     */

    Route::resource("services", "dashboard\ServiceController");

});

Route::prefix("dashboard")->group(function () {

    Route::get('/logout', "dashboard\UserController@logout");

    Route::any('/login', "dashboard\UserController@login");

});
