@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/branches/employees/'.$employee->id) }}" method="post" class="form-horizontal">
    @csrf
    @method('PATCH')


    {{ bs_input("username",$employee->user->name,true) }}
    {{ bs_email("email",$employee->user->email,true) }}
    {{ bs_input("phone",$employee->user->phone,true) }}


    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.window") }}
        </label>
        <div class="col-sm-6">
            <select name="window" class="form-control search-select">
                @foreach ($employee->branch->windows as $window)
                    <option value="{{$window->id}}" {{ selected($window->id,$employee->window_id) }}>{{$window->prefix}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.services") }}
        </label>
        <div class="col-sm-6">
            <select name="services[]" multiple class="form-control search-select">
                @foreach ($employee->branch->services as $service)
                <option value="{{$service->id}}" {{ $employee->serve($service->id) ? "selected" : "" }}>{{$service->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

 


    {{ bs_password("password",null,false,true) }}
	{{ bs_password("password_confirmation",null,false) }}

    {{ bs_save("save") }}


</form>
@endsection

