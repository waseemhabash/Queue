<?php

Route::any("employee/login", "AuthController@login");

Route::middleware("employeeAuth")->group(function () {
    Route::get("employee/logout", "AuthController@logout");
    Route::post("employee/next", "QueueController@next");
    Route::get("employee", "QueueController@index");
});
