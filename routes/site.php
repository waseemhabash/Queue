<?php

Route::any("employee/login", "employee\AuthController@login");

Route::middleware("employeeAuth")->namespace("employee")->group(function () {
    Route::get("employee", "QueueController@index");
    Route::get("employee/check_call", "QueueController@check_call");
    Route::get("employee/skip", "QueueController@skip");
    Route::get("employee/start_service", "QueueController@start_service");
    Route::get("employee/end_service", "QueueController@end_service");
    Route::get("employee/logout", "AuthController@logout");
});


Route::get("branch/screen","branch\ScreenController@index");
Route::get("screen/delete_call", "employee\QueueController@delete_call");
