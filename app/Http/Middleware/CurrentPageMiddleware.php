<?php

namespace App\Http\Middleware;

use Closure;

class CurrentPageMiddleware
{

    public function handle($request, Closure $next, $page)
    {

        session()->put("c_page", $page);

        return $next($request);
    }
}
