@extends('dashboard.layouts.index')

@section('content')


<form role="form" class="form-horizontal" action="{{ url('dashboard/roles/'.$role->id) }}" method="post">
    @csrf
    @method("PATCH")
    
    {{ bs_input("name",$role->name,true) }}

    <div class="form-group">
        <label class="col-sm-1 control-label" style='text-align:right'>
            {{ __("dashboard.privileges") }}
        </label>
        <div class="col-sm-6">
            <select class="form-control search-select" multiple required name="privileges[]">
                @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}" {{ $role->has_privilege($privilege->id) ? "selected" : "" }}>{{ __("dashboard.$privilege->name") }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{ bs_save("save") }}
</form>


@endsection
