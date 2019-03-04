<?php


namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function storeTapId(Request $request){
        session(['tapId' => $request->href]);
        
               return response()->json([
          'data' => [
            'success' => $request->href,
        ]
    ]);
    }


    public function index()
    {
        $companies = Company::with(["manger"])->get();

        return view('dashboard.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('dashboard.companies.add');
    }

    public function store()
    {
        Company::create_company();

        return redirect('dashboard/companies')->with("success", __("dashboard.added_successfully"));
    }

    public function show(Company $company)
    {

        $canAccess = auth()->user()->type == "admin";

        if (!$canAccess) {
            return redirect("dashboard/home")->with("error", __("dashboard.access_denied"));
        }

        session()->put("company_id", $company->id);

        session()->put("hash", session("hash") ?? "generalInfo");

        return view("dashboard.companies.show", compact("company"));
    }

    public function edit(Company $company)
    {
        return view('dashboard.companies.edit', compact('company'));
    }

    public function update(Company $company)
    {
        Company::update_company($company);

        return redirect('dashboard/companies')->with("success", __("dashboard.updated_successfully"));
    }

    public function destroy(Company $company)
    {
        \DB::beginTransaction();

        try {
            $company->delete();
            $company->manger->delete();
            $company->manger->user->delete();
        } catch (\Throwable $th) {
            return back()->with("error", __("dashboard.related_data_error"));
        }

        \DB::commit();

        return redirect('dashboard/companies')->with("success", __("dashboard.deleted_successfully"));
    }
}
