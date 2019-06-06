@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/branches/$branch->id/ticketsEmployees") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("username",'',true) }}
    {{ bs_email("email",'',true) }}
    {{ bs_input("phone",'',true) }}


    


    {{ bs_password("password",null,true) }}
    {{ bs_password("password_confirmation",null,true) }}

    {{ bs_save("save") }}

</form>
@endsection
