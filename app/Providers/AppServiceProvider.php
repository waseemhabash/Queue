<?php

namespace App\Providers;

use App\Models\Constant;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {

        

        view()->share(["c" => Constant::get_constants()]);

    }
}
