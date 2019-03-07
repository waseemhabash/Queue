@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/branches/$branch_id/services") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}
    {{ bs_text("description",null,true) }}

    {{ bs_number("timeInMinutes",null,true) }}

    {{ bs_tag("requirements",null,true) }}



    {{ bs_save("save") }}


</form>
@endsection

