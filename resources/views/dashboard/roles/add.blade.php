@extends('dashboard.layouts.index')

@section('content')


<form role="form" class="form-horizontal" action="{{ url('dashboard/roles/') }}" method="post">
    @csrf
    @method("POST")

    {{ bs_input("name",null,true) }}

    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">
            {{ __("dashboard.privileges") }}
        </label>
        <div class="col-sm-6">
            <select class="form-control search-select" multiple required name="privileges[]">
                @foreach ($privileges as $privilege)
                <option value="{{ $privilege->id }}">{{ __("dashboard.$privilege->name") }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{ bs_save("save") }}
</form>


@endsection
