@extends('dashboard.layouts.index')

@section('content')

<a href='{{ url("dashboard/employees/create") }}'>
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

        @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->user->name }}</td>
            <td>{{ $employee->user->phone }}</td>
            <td>{{ $employee->user->email }}</td>
            <td>


                <a href='{{ url("dashboard/employees/$employee->id/edit") }}' class="btn btn-xs btn-teal tooltips"
                    data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i>
                </a>
                <form action='{{ url("/dashboard/employees/$employee->id") }}' method="POST" style="display:inline">
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
            <canvas id="CustomerServiced" style="display: block; height: 750px; width: 1127px;"
                class="chartjs-render-monitor">
            </canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div style="width:100%;">
            <canvas id="customerRated" style="display: block; height: 750px; width: 1127px;"
                class="chartjs-render-monitor">
            </canvas>
        </div>
    </div>
</div>






@endsection



@section("assets")
<script>
    $.ajax({
        url: "{{ url('/dashboard/branch/CustomerServiced') }}",
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
                        text: 'عدد الزبائن المخدمين'
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
            for (let i = 0; i < employees.length; i++) {
                config.data.datasets.push({
                    label: employees[i].name,
                    backgroundColor: [getRandomColor(i)],
                    data: [
                        employees[i].customers
                    ],
                });
            }

            var ctx = document.getElementById('CustomerServiced').getContext('2d');
            window.myLine = new Chart(ctx, config);
        }
    });

    $.ajax({
        url: "{{ url('/dashboard/branch/customerRated') }}",
        success: function (res) {
            var config = {
                type: 'bar',
                data: {
                    labels: ["التقييم"],
                    datasets: []
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'تقييم الموظفين'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize : 0.5
                            }
                        }]
                    },
                }
            };
            var employees = res.employees;
            for (let i = 0; i < employees.length; i++) {
                config.data.datasets.push({
                    label: employees[i].name,
                    backgroundColor: [getRandomColor(i)],
                    data: [
                        employees[i].rate
                    ],
                });
            }

            var ctx = document.getElementById('customerRated').getContext('2d');
            window.myLine = new Chart(ctx, config);
        }
    })

</script>
@endsection