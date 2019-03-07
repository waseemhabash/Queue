@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/branches/windows/'.$window->id) }}" method="post" class="form-horizontal">
    @csrf
    @method('PATCH')


    {{ bs_input("name",$window->prefix,true) }}

    {{ bs_save("save") }}


</form>
@endsection

