@extends('dashboard.layouts.index')

@section('content')

<a href="{{ url('dashboard/roles/create') }}">
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus"></i> {{ __("dashboard.addX",["X" => __("dashboard.role")]) }}
    </button>
</a>


<table class="table table-hover">
    <thead>
        <tr>
            <th>{{ __("dashboard.name") }}</th>
            <th>{{ __("dashboard.privileges") }}</th>
            <th>{{ __("dashboard.options") }}</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td style="width:60%">
                @foreach ($role->privileges as $privilege)
                <span class="label label-inverse" style="margin-left: 10px;margin-bottom: 10px;">{{
                    __("dashboard.$privilege->name") }}</span>
                @endforeach
            </td>
            <td>
                <a href='{{ url("dashboard/roles/$role->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i></a>
                <form action='{{ url("/dashboard/roles/$role->id") }}' method="POST" style="display:inline">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-xs btn-bricky tooltips" data-placement="top"
                        data-original-title="{{ __('dashboard.delete') }}"><i class="fa fa-times fa fa-white"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>



@endsection
