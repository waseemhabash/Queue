<?php
use App\Models\Branch;
Route::get("/tt", function () {

    dd(Branch::all());

    
});
