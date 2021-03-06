@extends('dashboard.layouts.index')

@section('content')

<a href="{{ url('dashboard/admins/create') }}">
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus"></i> {{__("dashboard.addX",["X"=>__("dashboard.admin")])}}
    </button>
</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>{{__("dashboard.name")}}</th>
            <th>{{__("dashboard.email")}}</th>

            <th>{{ __("dashboard.options") }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            
            <td>
                <a href='{{ url("dashboard/admins/$admin->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i></a>
                <form class="delete-admin" action='{{ url("/dashboard/admins/$admin->id") }}' method="POST" style="display:inline">
                    @csrf
                    @method("delete")
                    <button class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="{{__('dashboard.delete')}}">
                        <i class="fa fa-times fa fa-white"></i></button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection
