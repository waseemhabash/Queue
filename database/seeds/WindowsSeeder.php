<?php

use Illuminate\Database\Seeder;
use App\Models\Window;

class WindowsSeeder extends Seeder
{
    
    public function run()
    {
        $window = new Window();
        $window->branch_id = 1;
        $window->prefix = 5;
        $window->save();
    }
}
