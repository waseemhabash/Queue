<?php

namespace App\Providers;

use App\Models\Constant;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {

        $c = Constant::get_constants();

        view()->share(compact(["c"]));

    }
}
