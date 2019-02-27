@extends('dashboard.layouts.index')

@section('content')
<form role="form" action="{{ url('dashboard/admins') }}" class="form-horizontal" method="post">
    @csrf
    @method("POST")

    {{bs_input("name",null,true)}}

	{{bs_email("email",null,true)}}
	
    {{bs_number("phone",null,false)}}

    <div class="form-group">
        <label for="col-sm-1">
            <?= __("dashboard.role") ?>
        </label>
        <div class="col-sm-6" style="    margin-right: 100px;">
            <select name="roles[]" multiple class="form-control search-select">
                @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

	{{bs_password("password",null,true)}}
	
    {{bs_password("rePassword",null,true)}}

    {{bs_save("save")}}
</form>
@endsection
