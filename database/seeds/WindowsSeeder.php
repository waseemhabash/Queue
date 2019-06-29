<?php

use App\Models\Window;
use Illuminate\Database\Seeder;

class WindowsSeeder extends Seeder
{

    public function run()
    {

        $branches =
            [

            [
                "windows" =>
                [

                    [
                        "branch_id" => 1,
                        "prefix" => 1,

                    ],
                    [
                        "branch_id" => 1,
                        "prefix" => 2,
                    ],
                ],
            ],
            [
                "windows" =>
                [

                    [
                        "branch_id" => 2,
                        "prefix" => 1,

                    ],
                    [
                        "branch_id" => 2,
                        "prefix" => 2,
                    ],
                ],
            ],
            [
                "windows" =>
                [

                    [
                        "branch_id" => 3,
                        "prefix" => 1,

                    ],
                    [
                        "branch_id" => 3,
                        "prefix" => 2,
                    ],
                ],
            ],
            [
                "windows" =>
                [

                    [
                        "branch_id" => 4,
                        "prefix" => 1,

                    ],
                    [
                        "branch_id" => 4,
                        "prefix" => 2,
                    ],
                ],
            ],

        ];
        foreach ($branches as $branch) {
            foreach ($branch["windows"] as $window) {
                $newWindow = new Window();
                $newWindow->branch_id = $window["branch_id"];
                $newWindow->prefix = $window["prefix"];
                $newWindow->save();
            }

        }

    }
}
