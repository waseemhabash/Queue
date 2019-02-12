<?php



Route::prefix("dashboard")->middleware("dashboardMiddleware")->group(function(){

    Route::get('/home', function () {
        return view('dashboard.layouts.index');
    });

});