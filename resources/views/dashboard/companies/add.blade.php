@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/companies/') }}" method="post" class="form-horizontal" enctype="multipart/form-data">	
	@csrf
	@method('POST')

	{{ bs_input("name",'',true) }}
    {{ bs_text("description",'',true) }}
    {{ bs_image("logo",'',true) }}



    <div class="page-header">
        <h1>{{ __("dashboard.userInfo") }}</h1>
    </div>

    {{ bs_input("username",'',true) }}
    {{ bs_email("email",'',true) }}
    {{ bs_input("phone",'',true) }}
    {{ bs_password("password",null,true) }}
	{{ bs_password("password_confirmation",null,true) }}
	
	{{ bs_save("save") }}
	

</form>
@endsection 