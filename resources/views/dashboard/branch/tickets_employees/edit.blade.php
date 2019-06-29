@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/tickets-employees/'.$employee->id) }}" method="post" class="form-horizontal">
    @csrf
    @method('PATCH')


    {{ bs_input("username",$employee->user->name,true) }}
    {{ bs_email("email",$employee->user->email,true) }}
    {{ bs_input("phone",$employee->user->phone,true) }}


 


    {{ bs_password("password",null,false,true) }}
	{{ bs_password("password_confirmation",null,false) }}

    {{ bs_save("save") }}


</form>
@endsection

