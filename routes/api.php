<?php

Route::middleware('apiAuth:customer')->namespace('api\user')->group(function () {

    /**
     * Notifications
     */

    Route::post("register_device", 'AuthController@register_device');


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
    Route::post("service/rate", "ServiceController@rate");
    Route::post("reservation", "ReservationController@reservation");
    Route::post("delete_reservation", "ReservationController@delete_reservation");
    Route::post("confirm_reservation", "ReservationController@confirm_reservation");
    Route::post("extend_reservation", "ReservationController@extend_reservation");

    /**
     * Profile
     */

    Route::get("profile", "ProfileController@get_profile");


    /**
     * Favorite
     */

    Route::get("favorites", "FavoriteController@favorites");
    Route::post("make_favorite", "FavoriteController@make_favorite");
    Route::post("unmake_favorite", "FavoriteController@unmake_favorite");

    
    
    
});

Route::middleware('apiAuth:tickets_employee')->namespace('api\tickets_employee')->group(function () {

    Route::post("online-queue", "MainController@online_queue");
    Route::post("normal-queue", "MainController@normal_queue");
    Route::get("get-services", "MainController@get_services");

});

Route::post("ticketsEmployee/login", "api\\tickets_employee\MainController@login");
Route::post('signup', 'api\user\AuthController@signup');
