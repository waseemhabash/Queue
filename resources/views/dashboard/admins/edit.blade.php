@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/admins/'.$admin->id) }}" class="form-horizontal" method="post">
    @csrf
    @method('PATCH')

    {{ bs_input("username",$admin->name,true) }}
    {{ bs_input("email",$admin->email,true) }}
    {{ bs_input("phone",$admin->phone,true) }}

    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.roles") }}
        </label>
        <div class="col-sm-6">
            <select name="roles[]" multiple="multiple" class="form-control search-select">
                @foreach ($roles as $role)
                <option value="{{$role->id}}" {{ $admin->has_role($role->id) ? "selected" : "" }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{ bs_password("password",null,false) }}
    {{ bs_password("password_confirmation",null,false) }}

    {{ bs_save("save") }}
</form>
@endsection
