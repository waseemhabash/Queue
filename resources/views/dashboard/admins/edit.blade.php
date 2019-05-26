@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/admins/'.$admin->id) }}" class="form-horizontal" method="post">
    @csrf
    @method('PATCH')

    {{ bs_input("username",$admin->name,true) }}
    {{ bs_input("email",$admin->email,true) }}
    {{ bs_input("phone",$admin->phone,true) }}

    

    {{ bs_password("password",null,false) }}
    {{ bs_password("password_confirmation",null,false) }}

    {{ bs_save("save") }}
</form>
@endsection
