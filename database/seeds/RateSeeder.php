<?php

use App\Models\Queue;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{

    public function run()
    {
        $queues = Queue::get();
        $queues = $queues->random($queues->count() - 200);

        foreach ($queues as $index => $queue) {
            $rate = new Rate();
            $rate->queue_id = $queue->id;
            $rate->rate = round(rand(1, 5));
            $rate->save();
        }
    }
}
