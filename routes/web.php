<?php

use App\Models\User;
use App\Notifications\users\RateServiceNotification;
Route::get("/migrateFreshSeed", function () {
    \Artisan::call('migrate:fresh --seed');
});

Route::get("/configCache", function () {
    \Artisan::call('config:cache');
});

Route::get("/", function () {
    $user = User::first();
    $user->notify(new RateServiceNotification("service"));
});
