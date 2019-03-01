

@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('dashboard/admins') }}" class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{bs_input("username",null,true)}}

	{{bs_email("email",null,true)}}
	
    {{bs_input("phone",null,true)}}

    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.roles") }}
        </label>
        <div class="col-sm-6">
            <select name="roles[]" multiple class="form-control search-select">
                @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

	{{bs_password("password",null,true)}}
	
    {{bs_password("password_confirmation",null,true)}}

    {{bs_save("save")}}
</form>
@endsection
