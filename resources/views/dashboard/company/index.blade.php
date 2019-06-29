@extends('dashboard.layouts.index')

@section('content')


<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
        <li class="{{ hash_page('generalInfo') }}">
            <a data-toggle="tab" href="#generalInfo">
                {{ __("dashboard.generalInfo") }}
            </a>
        </li>


    </ul>

    <div class="tab-content">
        <div id="generalInfo" class="tab-pane {{ hash_page('generalInfo') }}">
            <div class="row">
                <div class="col-sm-5 col-md-5">
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
                <div class="col-sm-7 col-md-7">

                    <div class="col-md-12">
                        <div style="width:100%;">

                            <canvas id="customerBranchStatistic" style="display: block; height: 750px; width: 1127px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@section("assets")
<script>
    $(function () {
        $.ajax({
            url: "{{ url('/dashboard/company/customerBranchStatistic') }}",
            success: function (res) {
                var config = {
                    type: 'bar',
                    data: {
                        labels: ["عدد الزبائن"],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: ' عدد الزبائن ضمن الفروع'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                };
                var branches = res.branches;
                for (let i = 0; i < branches.length; i++) {
                    config.data.datasets.push({
                        label: branches[i].name,
                        backgroundColor: [getRandomColor(i)],
                        data: [
                            branches[i].customers
                        ],
                    });
                }
                var ctx = document.getElementById('customerBranchStatistic').getContext('2d');
                new Chart(ctx, config);

            }
        });
    });

</script>
@endsection
