<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Constant extends Model
{

    public static function get_constants()
    {
        $constants = Constant::all();

        $constants = Arr::pluck($constants, 'value', 'indexx');

        return (Object) $constants;
    }

    public static function update_constant()
    {
        $inputs = request()->input();
        $inputs = Arr::except($inputs, ['_token', "_method"]);

        foreach ($inputs ?? [] as $indexx => $value) {
            $constant = Constant::where("indexx", $indexx)->first();
            $constant->value = $value ?? "";
            $constant->update();
        }
        foreach (request()->file() ?? [] as $indexx => $value) {
            $constant = Constant::where("indexx", $indexx)->first();
            $constant->value = upload_file($value, "assets/uploads/constants/", $constant->value) ?? $constant->value;
            $constant->update();
        }

    }
}
