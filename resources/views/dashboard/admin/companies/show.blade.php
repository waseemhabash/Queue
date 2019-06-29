@extends('dashboard.layouts.index')

@section('content')


<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
        <li class="{{ hash_page('generalInfo') }}">
            <a data-toggle="tab" href="#generalInfo">
                {{ __("dashboard.generalInfo") }}
            </a>
        </li>

        <li class="{{ hash_page('branches') }}">
            <a data-toggle="tab" href="#branches">
                {{ __("dashboard.branches") }}
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="generalInfo" class="tab-pane {{ hash_page('generalInfo') }}">
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="user-left">
                        <div class="center">
                            <h4>{{ $company->name }}</h4>
                            <div class="user-image">
                                <img src="{{ url($company->logo) }}" width="50%">

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
                                    <td>{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.created_at") }}</td>
                                    <td>{{ $company->created_at->format("Y-m-d") }}</td>
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
                                    <td>{{ $company->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.email") }}</td>
                                    <td>{{ $company->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("dashboard.phone") }}</td>
                                    <td>{{ $company->user->phone }}</td>
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
                                    <td>{!! $company->description !!}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-sm-7 col-md-8">

                </div>
            </div>
        </div>
        <div id="branches" class="tab-pane {{ hash_page('branches') }}">



            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__("dashboard.name")}}</th>
                        <th>{{__("dashboard.phone")}}</th>
                        <th>{{__("dashboard.ownerName")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->branches as $branch)
                    <tr>
                        <td>{{$branch->name}}</td>
                        <td>{{$branch->user->phone}}</td>
                        <td>{{ $branch->user->name }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
