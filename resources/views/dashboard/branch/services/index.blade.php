@extends('dashboard.layouts.index')

@section('content')
<a href='{{ url("dashboard/services/create") }}'>
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
        @foreach ($services as $service)
        <tr>
            <td>{{ $service->name }}</td>

            <td>
                <a href='{{ url("dashboard/services/$service->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                </a>
                <form action='{{ url("/dashboard/services/$service->id") }}' method="POST" style="display:inline">
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



<div class="row">


    <div class="col-md-6">
        <div style="width:100%;">
            <canvas id="avgTimeService" style="display: block; height: 750px; width: 1127px;"
                class="chartjs-render-monitor">
            </canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div style="width:100%;">

            <canvas id="mostOrderedService" style="display: block; height: 563px; width: 1127px;"
                class="chartjs-render-monitor"></canvas>

            <p class=" text-center">يبدو أن الخدمة ( <span id="mostOrderedServiceName" style="font-weight: bold"></span> ) من أكثر الخدمات طلباً
                في هذا الفرع</p>
        </div>
    </div>
</div>
@endsection

@section('assets')

<script>
    $.ajax({
        url: "{{ url('/dashboard/branch/avgTimeService') }}",
        success: function (res) {
            var config = {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: ["المتوسط الحسابي للوقت"],
                        backgroundColor: [],
                        data: []
                    }, {
                        label: ["الوقت الحقيقي"],
                        backgroundColor: [],
                        data: []
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'المتوسط الحسابي للوقت الذي تستغرقه الخدمة'
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
            var employees = res.employees;
            var dataset1 = config.data.datasets[0];
            var dataset2 = config.data.datasets[1];
            for (let i = 0; i < employees.length; i++) {
                dataset1.data.push(employees[i].time);
                dataset2.data.push(employees[i].real_time);

                dataset1.backgroundColor.push(getRandomColor(100));
                dataset2.backgroundColor.push(getRandomColor(75));
                config.data.labels.push(employees[i].name);
            }

            var ctx = document.getElementById('avgTimeService').getContext('2d');
            window.myLine = new Chart(ctx, config);
        }
    });


    $.ajax({
        url: "{{ url('/dashboard/branch/mostOrderedService') }}",
        success: function (res) {
            var config = {
                type: 'pie',
                label: "Waseem",
                data: {
                    datasets: [{
                        data: [],
                        backgroundColor: [],
                    }],
                    labels: []
                },
                options: {
                    title: {
                        display: true,
                        text: 'النسبة المئوية لطلب الخدمات'
                    },
                    responsive: true
                },
            };

            var services = res.services;
            var dataset = config.data.datasets[0];
            var all_services_count = 0;
            var max = 0;
            var name;
            for (let i = 0; i < services.length; i++) {
                all_services_count += services[i].order_count;
                if (services[i].order_count > max) {
                    max = services[i].order_count;
                    name = services[i].name;
                }


            }

            for (let i = 0; i < services.length; i++) {
                dataset.data.push(Math.round(services[i].order_count / all_services_count * 100));
                config.data.labels.push(services[i].name);
                dataset.backgroundColor.push(getRandomColor(i));
            }

            $("#mostOrderedServiceName").html(name);
            var ctx = document.getElementById('mostOrderedService').getContext('2d');
            new Chart(ctx, config);
        }
    });

</script>
@endsection
