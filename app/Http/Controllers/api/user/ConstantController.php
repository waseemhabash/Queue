<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Constant;

class ConstantController extends Controller
{
    public function get_constants()
    {
        $constants = Constant::get_constants();

        res([
            "constants" => $constants,
        ]);
        exit;
    }
}
