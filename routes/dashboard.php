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

});

Route::prefix("dashboard")->group(function () {

    Route::get('/logout', "dashboard\HomeController@logout");
    Route::any('/login', "dashboard\HomeController@login");

});
