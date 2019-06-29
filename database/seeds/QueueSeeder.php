<?php

use App\Models\Branch;
use App\Models\Queue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class QueueSeeder extends Seeder
{

    public function run()
    {
        $branches = Branch::all();

        foreach ($branches as $branch) {
            $max = floor(rand(10,100));

            for ($i = 29; $i > 0; $i--) {
                for ($j = 0; $j < $max; $j++) {
                    $service = $branch->services->random(1)->first();
                    $queue = new Queue();
                    $number = floor(rand(1,4));
                    $queue->number = $number * 100 + ($j + 1);
                    $queue->priority = $number;
                    $queue->service_id = $service->id;
                    $queue->employee_id = $branch->employees->random(1)->first()->id;
                    $queue->customer_id = User::where("type", "customer")->get()->random(1)->first()->id;
                    $queue->start_served = Carbon::parse($branch->open_time)->addMinutes($j * 1);
                    $queue->end_served = Carbon::parse($branch->open_time)->addMinutes($j * 2);

                    $queue->created_at = Carbon::parse($branch->open_time)->subDays($i);
                    $queue->updated_at = Carbon::parse($branch->open_time)->subDays($i);
                    $queue->save();

                }
            }
        }

    }
}
