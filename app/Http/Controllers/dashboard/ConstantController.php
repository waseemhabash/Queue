<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Constant;

class ConstantController extends Controller
{

    public function index()
    {
        $constants = Constant::all();
        return view("dashboard.settings.constant",compact("constants"));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        Constant::update_constant();
        return back()->with("success",__("dashboard.updated_successfully"));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
