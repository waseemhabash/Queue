<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class ApiAuthMiddleware
{

    public function handle($request, Closure $next, $user_type)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $th) {
            error_res([
                "errors" => [
                    "2" => __("api.TokenError"),
                ],
            ]);

            exit;
        }

        if ($user_type != $user->type) {
            error_res([
                "errors" => [
                    "3" => __("api.accessDenied"),
                ],
            ]);

            exit;
        }

        return $next($request);
    }
}
