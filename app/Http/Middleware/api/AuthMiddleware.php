<?php

namespace App\Http\Middleware\api;

use Closure;
use JWTAuth;

class AuthMiddleware
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

        if (!$user || $user_type != $user->type) {
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
