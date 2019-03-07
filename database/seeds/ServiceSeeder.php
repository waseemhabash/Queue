<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->name = "Service Name";
        $service->description = "Service Description";
        $service->time = 2;
        $service->requirements = 'requirement1,requirement2';
        $service->branch_id = 1;
        $service->save();
    }
}
