<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Company;
    

class CompanyController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies=Company::all();

        return view('dashboard.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users=User::where("type","admin")->where('id',"!=",auth()->id())->get();

        return view('dashboard.companies.add',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company=New Company();

        $company->name=$request->name;

        $company->phone=$request->phone;
        $company->user_id=$request->user_id;        
        $company->description=$request->description;        

        $company->save();
        

        return redirect('dashboard/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {

        $users=User::where("type","admin")->where('id',"!=",auth()->id())->get();

        return view('dashboard.companies.edit',compact('users','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company)
    {
      $company=New Company();

      $company->name=$request->name;

      $company->phone=$request->phone;
      $company->user_id=$request->user_id;        
      $company->description=$request->description;        

      $company->update();     

      return redirect('dashboard/companies');    
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('dashboard/companies');
    }
}
