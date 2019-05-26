

@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('dashboard/admins') }}" class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("username",null,true) }}

	{{ bs_email("email",null,true) }}
	
    {{ bs_input("phone",null,true) }}

	{{ bs_password("password",null,true) }}
	
    {{ bs_password("password_confirmation",null,true) }}

    {{ bs_save("save")}}
</form>
@endsection
