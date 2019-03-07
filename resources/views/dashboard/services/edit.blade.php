@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/branches/services/'.$service->id) }}" method="post" class="form-horizontal">
    @csrf
    @method('PATCH')


    {{ bs_input("name",$service->name,true) }}
    {{ bs_text("description",$service->description,true) }}

    {{ bs_number("timeInMinutes",$service->time,true) }}

    {{ bs_tag("requirements",$service->requirements,true) }}


    {{ bs_save("save") }}


</form>
@endsection

