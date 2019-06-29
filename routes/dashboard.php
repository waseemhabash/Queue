<?php

/**
 * Admin
 */

Route::prefix("dashboard")->middleware("dashboard")->namespace("dashboard\admin")->group(function () {

    /**
     * Home
     */

    Route::get("admin/homeStatistic", "StatisticsController@adminHomeStatistic");

    /**
     * Admins
     */

    Route::resource("admins", "AdminController");

    /*
     * Companies
     */

    Route::resource("companies", "CompanyController");

    /**
     * constants
     */

    Route::get("constants", "ConstantController@index");
    Route::post("constants/update", "ConstantController@update");

});

/**
 * Company
 */

Route::prefix("dashboard")->middleware("dashboard")->namespace("dashboard\company")->group(function () {

    /**
     * Home
     */
    Route::get("company/customerBranchStatistic", "StatisticsController@customerBranchStatistic");
    Route::get("company/customerBranchPieStatistic", "StatisticsController@customerBranchPieStatistic");
    Route::get("company/rateBranchStatistic", "StatisticsController@rateBranchStatistic");
    Route::get("company", "CompanyController@index");

    /**
     * branches
     */

    Route::resource("branches", "BranchController");

});

/**
 * Branch
 */

Route::prefix("dashboard")->middleware("dashboard")->namespace("dashboard\branch")->group(function () {

    Route::get("branch", "BranchController@index");

    Route::get("branch/mostOrderedService","StatisticsController@mostOrderedService");
    Route::get("branch/CustomerServiced","StatisticsController@CustomerServiced");
    Route::get("branch/customerRated","StatisticsController@customerRated");
    Route::get("branch/avgTimeService","StatisticsController@avgTimeService");
    /**
     * branches
     */

    Route::resource("services", "ServiceController");
    Route::get("delete_service_image/{image_id}", "ServiceController@delete_service_image");
    Route::resource("windows", "WindowController");
    Route::resource("employees", "EmployeeController");
    Route::resource("tickets-employees", "TicketsEmployeeController");

});

Route::prefix("dashboard")->namespace("dashboard")->group(function () {
    Route::get('/', "HomeController@index")->middleware("dashboard");

    Route::get("/change_hash_tab/{hash}", function ($hash) {
        session()->put("hash", $hash);
    });

    Route::get('/logout', "UserController@logout");

    Route::any('/login', "UserController@login");

});
