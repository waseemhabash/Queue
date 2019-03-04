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

    /**
     * constants
     */

    Route::resource("constants", "dashboard\ConstantController")->middleware("dashboardMiddleware:constant_management");
    /*
     * Companies
     */

    Route::resource("companies", "dashboard\CompanyController")->middleware("dashboardMiddleware:companies_management");

    /**
     * Branches
     */

    Route::resource("branches", "dashboard\BranchController")->middleware("dashboardMiddleware:branches_management");

    /**
     * Services
     */

    Route::resource("services", "dashboard\ServiceController");

    /**
    * Store Tap Id In Session
    */
    Route::post('/tap', "dashboard\CompanyController@storeTapId");
});

Route::prefix("dashboard")->group(function () {
    
    Route::get("/change_hash_tab/{hash}",function($hash){
        session()->put("hash",$hash);
    });

    Route::get('/logout', "dashboard\UserController@logout");

    Route::any('/login', "dashboard\UserController@login");

});
