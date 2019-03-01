

@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('dashboard/branches') }}" class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}
    {{ bs_input("address",null,true) }}
    {{ bs_text("description",null,true) }}

    <input hidden name="lng" value="1.5">
    <input hidden name="lat" value="1.5">



    <div class="page-header">
        <h1>{{ __("dashboard.ownerInfo") }}</h1>
    </div>

    {{ bs_input("username",null,true) }}
    {{ bs_email("email",null,true) }}
    {{ bs_input("phone",null,true) }}
    {{ bs_password("password",null,true) }}
    {{ bs_password("password_confirmation",null,true) }}
    {{ bs_save("save") }}

</form>
@endsection
