<?php

namespace App\Http\Controllers\site\branch;

use App\Http\Controllers\Controller;
use App\Models\Temp_calling;

class ScreenController extends Controller
{
    public function index()
    {

        if (!is_type("branch_manager")) {
            return redirect("dashboard/login");
        }

        $branch = myBranch();
        $branch->temp_callings()->delete();
        return view("site.branch.screen", compact("branch"));
    }

    public function delete_temp_call()
    {
        Temp_calling::where("branch_id", request("branch_id"))->where("number", request("number"))->where("window", request("window"))->first()->delete();
        res([
            "message" => "deleted successfully",
        ]);
        exit;
    }
}
