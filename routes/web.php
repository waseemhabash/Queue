<?php


Route::get("/migrateFreshSeed", function () {
    \Artisan::call('migrate:fresh --seed');
});

Route::get("/configCache", function () {
    \Artisan::call('config:cache');
});



