<?php

namespace App\Providers;

use App\Models\Constant;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        /* $this->app->bind('path.public', function() {
        return realpath(base_path().'/../public');
    }); */
    }

    public function boot()
    {

        view()->share(["c" => Constant::get_constants()]);

    }
}
