@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/services") }}' class="form-horizontal" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}
    {{ bs_text("description",null,true) }}

    {{ bs_number("timeInMinutes",null,true) }}

    {{ bs_tag("requirements",null,true) }}

    {{ bs_multiple_files("images",null,true,"image/*") }}

    {{ bs_save("save") }}


</form>
@endsection

