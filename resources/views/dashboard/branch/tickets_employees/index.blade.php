@extends('dashboard.layouts.index')

@section('content')
<a href='{{ url("dashboard/tickets-employees/create") }}'>
    <button class="btn btn-success" style="margin-bottom: 25px;">
        <i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.ticketsEmployees")])}}
    </button>
</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>{{__("dashboard.name")}}</th>
            <th>{{__("dashboard.phone")}}</th>
            <th>{{__("dashboard.email")}}</th>
            <th>{{ __("dashboard.options") }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets_employees as $tickets_employee)
        <tr>
            <td>{{ $tickets_employee->user->name }}</td>
            <td>{{ $tickets_employee->user->phone }}</td>
            <td>{{ $tickets_employee->user->email }}</td>
            <td>


                <a href='{{ url("dashboard/tickets-employees/$tickets_employee->id/edit") }}'
                    class="btn btn-xs btn-teal tooltips" data-placement="top"
                    data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                </a>
                <form action='{{ url("/dashboard/tickets-employees/$tickets_employee->id") }}'
                    method="POST" style="display:inline">
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
