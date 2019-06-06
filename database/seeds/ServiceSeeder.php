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
        $service->name = "إيداع أموال";
        $service->description = "هناك رسوم أكبر تطبق على البلدان خارج القطر";
        $service->time = 2;
        $service->requirements = 'إدخال بيانات,لغة إنكليزية';
        $service->branch_id = 1;
        $service->save();
    }
}
