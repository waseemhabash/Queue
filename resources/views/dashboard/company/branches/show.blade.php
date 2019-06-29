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
                            <div class="user-image">
                                    <img src="{{ url($branch->image) }}" width="50%">
    
                                </div>
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


                        

                    </div>
                </div>
                <div class="col-sm-7 col-md-8">

                </div>
            </div>
        </div>
        <div id="services" class="tab-pane {{ hash_page('services') }}">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{__("dashboard.requirements")}}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($branch->services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->requirements }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div id="windows" class="tab-pane {{ hash_page('windows') }}">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{__("dashboard.created_at")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branch->windows as $window)
                    <tr>
                        <td>{{ $window->prefix }}</td>
                        <td>{{ $window->created_at->format("d-m-Y") }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div id="employees" class="tab-pane {{ hash_page('employees') }}">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{__("dashboard.phone")}}</th>
                        <th>{{__("dashboard.email")}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($branch->employees as $employee)
                    <tr>
                        <td>{{ $employee->user->name }}</td>
                        <td>{{ $employee->user->phone }}</td>
                        <td>{{ $employee->user->email }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div id="ticketsEmployees" class="tab-pane {{ hash_page('ticketsEmployees') }}">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{__("dashboard.phone")}}</th>
                        <th>{{__("dashboard.email")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branch->tickets_employees as $tickets_employee)
                    <tr>
                        <td>{{ $tickets_employee->user->name }}</td>
                        <td>{{ $tickets_employee->user->phone }}</td>
                        <td>{{ $tickets_employee->user->email }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>





@endsection
