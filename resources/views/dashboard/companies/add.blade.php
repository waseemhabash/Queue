@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/companies/'.$company->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">	
	@csrf
	@method('PATCH')

	{{ bs_input("name",$company->name,true) }}
    {{ bs_text("description",$company->description,true) }}
    {{ bs_image("logo",$company->logo,false) }}



    <div class="page-header">
        <h1>{{ __("dashboard.ownerInfo") }}</h1>
    </div>

    {{ bs_input("username",$company->user->name,true) }}
    {{ bs_email("email",$company->user->email,true) }}
    {{ bs_input("phone",$company->user->phone,true) }}
    {{ bs_password("password",null,false,true) }}
	{{ bs_password("password_confirmation",null,false) }}
	
	{{ bs_save("save") }}
	

</form>
@endsection 