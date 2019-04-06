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

});

Route::post('signup', 'api\user\AuthController@signup');
