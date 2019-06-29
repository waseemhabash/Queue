<?php

namespace App\Http\Controllers\site\employee;

use App\Http\Controllers\Controller;
use App\Models\Temp_calling;
use App\Notifications\users\RateServiceNotification;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function index()
    {
        $employee = myEmployee();

        $branch = $employee->branch;

        return view("site.employee.queue", compact("branch", "employee"));
    }

    public function check_call()
    {

        $employee = myEmployee();
        $branch = $employee->branch;
        $window = $employee->window;
        $next_in_queue = $employee->next_in_queue();

        if ($next_in_queue) {

            $next_in_queue->employee_id = $employee->id;
            $next_in_queue->update();

            $temp_calls = $branch->temp_callings;

            $wait = $temp_calls->count() * 5.25;

            $calling_data = [
                "branch_id" => $branch->id,
                "window" => $window->prefix,
                "number" => $next_in_queue->number,
                "employee_id" => $employee->id,
            ];

            if ($employee->temp_callings->isNotEmpty()) {
                error_res([
                    "code" => 3,
                ], 200);
                exit;
            }

            $temp_call = Temp_calling::create($calling_data);

            res([
                "wait" => $wait,
            ]);

            calling($next_in_queue->number, $window->prefix, $branch->id, $wait);
            update_queue($branch);

            exit;

        } else {
            error_res([
                "code" => 2,
            ], 200);
        }

        exit;

    }

    public function start_service()
    {
        $employee = myEmployee();
        $next_in_queue = $employee->calledAndNotServed();

        if ($next_in_queue) {
            $next_in_queue->start_served = Carbon::now();
            $next_in_queue->update();
        }

        update_queue($employee->branch);

        return back();
    }

    public function end_service()
    {
        $employee = myEmployee();
        $next_in_queue = $employee->startServedButNotFinished();

        if ($next_in_queue) {
            $next_in_queue->end_served = Carbon::now();
            $next_in_queue->update();

            if ($next_in_queue->customer) {
                try {
                    $next_in_queue->customer->notify(new RateServiceNotification($next_in_queue));
                } catch (\Throwable $th) {
                    
                }
            }

        }

        return back();
    }

    public function skip()
    {
        $employee = myEmployee();
        $next_in_queue = $employee->calledAndNotServed();

        if ($next_in_queue) {

            $next_in_queue->delete();

            update_queue($employee->branch);
        }

        return back();
    }

    public function delete_call()
    {
        Temp_calling::where([
            "branch_id" => request("branch_id"),
            "window" => request("window"),
            "number" => request("number"),
        ])
            ->orderby("id")
            ->first()
            ->delete();
    }

}
