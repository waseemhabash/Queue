<?php

use Illuminate\Database\Seeder;
use App\Models\Window;

class WindowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $window = new Window();
        $window->branch_id = 1;
        $window->prefix = "A";
        $window->save();
    }
}
