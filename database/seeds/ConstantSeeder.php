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
                'type' => "string",
                "indexx" => "facebook",
            ],
            
        ];

        foreach ($constants as $constant) {
            $constant = new Constant();
            $constant->indexx = $constant["indexx"];
            $constant->type = $constant['type'];
            $constant->value = "";
            $constant->save();
        }

    }
}
