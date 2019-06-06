@extends('dashboard.layouts.index')

@section('content')
<form role="form" action='{{ url("dashboard/branches/$branch->id/employees") }}' class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{ bs_input("username",'',true) }}
    {{ bs_email("email",'',true) }}
    {{ bs_input("phone",'',true) }}


    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.window") }}
        </label>
        <div class="col-sm-6">
            <select name="window" class="form-control search-select">
                @foreach ($branch->windows as $window)
                    <option value="{{$window->id}}">{{$window->prefix}}</option>
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
                @foreach ($branch->services as $service)
                <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
            </select>
        </div>
    </div>



    {{ bs_password("password",null,true) }}
    {{ bs_password("password_confirmation",null,true) }}

    {{ bs_save("save") }}

</form>
@endsection
