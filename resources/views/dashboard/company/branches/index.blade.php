@extends('dashboard.layouts.index')

@section('content')


<a href='{{ url("dashboard/branches/create") }}'>
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.branch")])}}
    </button>
</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>{{__("dashboard.name")}}</th>
            <th>{{__("dashboard.address")}}</th>
            <th>{{__("dashboard.openTime")}}</th>
            <th>{{__("dashboard.ownerName")}}</th>
            <th>{{__("dashboard.phone")}}</th>
            <th>{{ __("dashboard.options") }}</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($company->branches as $branch)
        <tr>
            <td>{{$branch->name}}</td>
            <td>{{$branch->address}}</td>
            <td>{{$branch->open_time}}</td>
            <td>{{$branch->user->phone}}</td>
            <td>{{ $branch->user->name }}</td>
            <td>

                <a href='{{ url("dashboard/branches/$branch->id") }}' class="btn btn-xs btn-purple tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.show') }}"><i class="fa fa-eye"></i>
                </a>

                <a href='{{ url("dashboard/branches/$branch->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                </a>
                <form action='{{ url("/dashboard/branches/$branch->id") }}' method="POST" style="display:inline">
                    @csrf
                    @method("delete")
                    <button class="btn btn-xs btn-bricky tooltips" data-placement="top"
                        data-original-title="{{__('dashboard.delete')}}">
                        <i class="fa fa-times fa fa-white"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection
