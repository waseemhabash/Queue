<?php





Route::get("/tt",function(){
    $position = Location::get("94.47.128.230");

    dd($position);
});