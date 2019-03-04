@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/companies') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method("POST")


    {{ bs_input("name",null,true) }}
    {{ bs_text("description",null,true) }}
    {{ bs_image("logo",null,true) }}



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