@extends('dashboard.layouts.index')

@section('content')

<a href="{{ url('dashboard/create') }}">
    <button class="btn btn-success">
        <i class="fa fa-plus"></i> {{ __("dashboard.addX",["X" => __("dashboard.role")]) }}
    </button>
</a>


<table class="table table-hover">
    <thead>
        <tr>
        <th>{{ __("dashboard.name") }}</th>
            <th>{{ __("dashboard.options") }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>

            <td>{{ $role->name }}</td>
            <td>
                <a href='{{ url("dashboard/roles/$role->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i></a>
                <form action='{{ url("/dashboard/roles/$role->id") }}' method="POST" style="display:inline">
                    @csrf
                    @method("delete")
                    <span class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="{{ __('dashboard.delete') }}"><i
                            class="fa fa-times fa fa-white"></i></span>

                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>



@endsection
