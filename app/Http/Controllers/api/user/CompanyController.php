<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{

    public function get_companies()
    {
        $companies = Company::paginate(10);

        res($companies);

    }

}
