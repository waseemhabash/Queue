<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();

        return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {

        //$users=User::where("type","admin")->where('id',"!=",auth()->id())->get();

        return view('dashboard.services.add');

    }

    public function store(Request $request)
    {
        $service = new Service();

        $service->name = $request->name;

        $service->description = $request->description;

        $service->save();

        return redirect('dashboard/services');
    }

    public function show($id)
    {
        //
    }

    public function edit(Service $service)
    {

        return view('dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service = new Service();

        $service->name = $request->name;

        $service->description = $request->description;

        $service->save();

        return redirect('dashboard/services');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect('dashboard/companies');
    }
}
