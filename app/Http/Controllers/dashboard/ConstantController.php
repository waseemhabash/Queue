<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class ConstantController extends Controller
{

    public function index()
    {
        $constants = Constant::all();
        return view();
    }

 
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
