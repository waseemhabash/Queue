<?php

use App\Models\Constant;
use Illuminate\Database\Seeder;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = [

            [
                "type" => "image",
                "indexx" => "logo",
            ],
        ];

        foreach ($constants as $const) {
            $constant = new Constant();
            $constant->indexx = $const["indexx"];
            $constant->type = $const['type'];
            $constant->value = "";
            $constant->save();
        }

    }
}
