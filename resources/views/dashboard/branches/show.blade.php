@extends('dashboard.layouts.index')

@section('content')


<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
        <li class="{{ hash_page('generalInfo') }}">
            <a data-toggle="tab" href="#generalInfo">
                {{ __("dashboard.generalInfo") }}
            </a>
        </li>
        <li class="{{ hash_page('services') }}">
            <a data-toggle="tab" href="#services">
                {{ __("dashboard.services") }}
            </a>
        </li>
        <li class="{{ hash_page('windows') }}">
            <a data-toggle="tab" href="#windows">
                {{ __("dashboard.windows") }}
            </a>
        </li>
        <li class="{{ hash_page('employees') }}">
            <a data-toggle="tab" href="#employees">
                {{ __("dashboard.employees") }}
            </a>
        </li>

        <li class="{{ hash_page('ticketsEmployees') }}">
            <a data-toggle="tab" href="#ticketsEmployees">
                {{ __("dashboard.ticketsEmployees") }}
            </a>
        </li>


    </ul>
    <div class="tab-content">
        <div id="generalInfo" class="tab-pane {{ hash_page('generalInfo') }}">
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="user-left">
                        <div class="center">
                            <h4>{{ $branch->name }}</h4>
                        </div>

                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.generalInfo") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __("dashboard.name") }}</td>
                                    <td>{{ $branch->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.address") }}</td>
                                    <td>{{ $branch->address }}</td>
                                </tr>

                                <tr>
                                    <td>{{ __("dashboard.theCompany") }}</td>
                                    <td>{{ $branch->company->name }}</td>
                                </tr>

                                <tr>
                                    <td>{{ __("dashboard.created_at") }}</td>
                                    <td>{{ $branch->created_at->format("Y-m-d") }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.userInfo") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __("dashboard.name") }}</td>
                                    <td>{{ $branch->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.email") }}</td>
                                    <td>{{ $branch->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.phone") }}</td>
                                    <td>{{ $branch->user->phone }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">{{ __("dashboard.description") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{!! $branch->description !!}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-sm-7 col-md-8">

                </div>
            </div>
        </div>
        <div id="services" class="tab-pane {{ hash_page('services') }}">
            <a href='{{ url("dashboard/branches/$branch->id/services/create") }}'>
                <button class="btn btn-success" style="margin-bottom: 25px;">
                    <i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.service")])}}
                </button>
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>

                        <th>{{ __("dashboard.options") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branch->services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>

                        <td>



                            <a href='{{ url("dashboard/branches/services/$service->id/edit") }}'
                                class="btn btn-xs btn-teal tooltips" data-placement="top"
                                data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                            </a>
                            <form action='{{ url("/dashboard/branches/services/$service->id") }}' method="POST"
                                style="display:inline">
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
        </div>
        <div id="windows" class="tab-pane {{ hash_page('windows') }}">
            <a href='{{ url("dashboard/branches/$branch->id/windows/create") }}'>
                <button class="btn btn-success" style="margin-bottom: 25px;">
                    <i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.window")])}}
                </button>
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{ __("dashboard.options") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branch->windows as $window)
                    <tr>
                        <td>{{ $window->prefix }}</td>

                        <td>
                            <a href='{{ url("dashboard/branches/windows/$window->id/edit") }}'
                                class="btn btn-xs btn-teal tooltips" data-placement="top"
                                data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                            </a>
                            <form action='{{ url("/dashboard/branches/windows/$window->id") }}' method="POST"
                                style="display:inline">
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
        </div>
        <div id="employees" class="tab-pane {{ hash_page('employees') }}">
            <a href='{{ url("dashboard/branches/$branch->id/employees/create") }}'>
                <button class="btn btn-success" style="margin-bottom: 25px;">
                    <i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.employee")])}}
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

                    @foreach ($branch->employees as $employee)
                    <tr>
                        <td>{{ $employee->user->name }}</td>
                        <td>{{ $employee->user->phone }}</td>
                        <td>{{ $employee->user->email }}</td>
                        <td>


                            <a href='{{ url("dashboard/branches/employees/$employee->id/edit") }}'
                                class="btn btn-xs btn-teal tooltips" data-placement="top"
                                data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                            </a>
                            <form action='{{ url("/dashboard/branches/employees/$employee->id") }}' method="POST"
                                style="display:inline">
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
        </div>

        <div id="ticketsEmployees" class="tab-pane {{ hash_page('ticketsEmployees') }}">
            <a href='{{ url("dashboard/branches/$branch->id/ticketsEmployees/create") }}'>
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
                    @foreach ($branch->tickets_employees as $tickets_employee)
                    <tr>
                        <td>{{ $tickets_employee->user->name }}</td>
                        <td>{{ $tickets_employee->user->phone }}</td>
                        <td>{{ $tickets_employee->user->email }}</td>
                        <td>


                            <a href='{{ url("dashboard/branches/ticketsEmployees/$tickets_employee->id/edit") }}'
                                class="btn btn-xs btn-teal tooltips" data-placement="top"
                                data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                            </a>
                            <form action='{{ url("/dashboard/branches/ticketsEmployees/$tickets_employee->id") }}'
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
        </div>

    </div>
</div>

@endsection
