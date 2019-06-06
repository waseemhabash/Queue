<?php

namespace App\Http\Controllers\site\employee;

use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function index()
    {

        $branch = auth()->user()->employee->branch;

        return view("site.employee.queue", compact("branch"));

    }

    public function next()
    {

    }
}
