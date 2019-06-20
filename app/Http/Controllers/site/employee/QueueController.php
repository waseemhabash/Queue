<?php

namespace App\Http\Controllers\site\employee;

use App\Http\Controllers\Controller;
use App\Models\Temp_calling;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        $branch = $employee->branch;

        return view("site.employee.queue", compact("branch", "employee"));
    }

    public function start_service()
    {
        $employee = auth()->user()->employee;
        $next_in_queue = $employee->next_in_queue();

        if ($next_in_queue && $next_in_queue->employee_id && $next_in_queue->employee_id == $employee->id) {
            $next_in_queue->start_served = Carbon::now();
            $next_in_queue->update();
        }

        update_queue($employee->branch);

        return back();
    }

    public function end_service()
    {
        $employee = auth()->user()->employee;
        $next_in_queue = $employee->startServedButNotFinished();

        if ($next_in_queue) {
            $next_in_queue->end_served = Carbon::now();
            $next_in_queue->update();
        }

        return back();
    }

    public function check_call()
    {

        $employee = auth()->user()->employee;
        $branch = $employee->branch;
        $next_in_queue = $employee->next_in_queue();

        if ($next_in_queue) {

            $next_in_queue->employee_id = $employee->id;
            $next_in_queue->update();

            $temp_calls = $branch->temp_callings;

            $wait = $temp_calls->count() * 5;

            $calling_data = [
                "branch_id" => $branch->id,
                "window" => $employee->window->prefix,
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

            calling($next_in_queue->number, $employee->window->prefix, $employee->branch->id, $wait);

            exit;

        } else {
            error_res([
                "code" => 2,
            ], 200);
        }

        exit;

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

    public function skip()
    {
        $employee = auth()->user()->employee;
        $next_in_queue = $employee->next_in_queue();

        if ($next_in_queue && $next_in_queue->employee_id && $next_in_queue->employee_id == $employee->id) {

            if ($next_in_queue->priority == 3) {
                $next_in_queue->delete();
            } else {
                $next_in_queue->increment("priority");
            }

            $next_in_queue->employee_id = null;
            $next_in_queue->update();

            update_queue($employee->branch);
        }

        return back();
    }

}
