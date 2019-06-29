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
                "indexx" => "slider1",
            ],
            [
                "type" => "image",
                "indexx" => "slider2",
            ],
            [
                "type" => "image",
                "indexx" => "slider3",
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
