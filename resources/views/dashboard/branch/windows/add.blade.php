@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/windows") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}

    {{ bs_save("save") }}

</form>
@endsection
