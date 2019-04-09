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

});

Route::post('signup', 'api\user\AuthController@signup');
