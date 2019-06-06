<?php

Route::middleware('apiAuth:customer')->namespace('api\user')->group(function () {

    /**
     * Notifications
     */

    Route::post("register_device", 'AuthController@register_device');

    Route::post("update_device", 'AuthController@update_device');

    /**
     * Companies
     */

    Route::get("companies", "CompanyController@get_companies");

    /**
     * Branches
     */

    Route::get("branches", "BranchController@get_branches");

    /**
     * services
     */

    Route::get("services", "ServiceController@get_services");
    Route::post("reservation", "ReservationController@reservation");
    Route::post("delete_reservation", "ReservationController@delete_reservation");
    Route::post("confirm_reservation", "ReservationController@confirm_reservation");

    /**
     * Profile
     */

    Route::get("profile", "ProfileController@get_profile");

});

Route::middleware('apiAuth:tickets_employee')->namespace('api\tickets_employee')->group(function () {

    Route::post("online-queue", "MainController@online_queue");
    Route::post("normal-queue", "MainController@normal_queue");
    Route::get("get-services", "MainController@get_services");

});

Route::post("ticketsEmployee/login", "api\\tickets_employee\MainController@login");
Route::post('signup', 'api\user\AuthController@signup');
