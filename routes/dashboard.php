<?php



Route::prefix("dashboard")->middleware("dashboardMiddleware")->group(function(){

    Route::get('/home',"dashboard\HomeController@index");

});



Route::prefix("dashboard")->group(function(){

    Route::any('/login',"dashboard\HomeController@login");
    Route::get('/logout',"dashboard\HomeController@logout");

});