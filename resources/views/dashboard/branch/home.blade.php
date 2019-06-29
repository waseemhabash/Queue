@extends('dashboard.layouts.index')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div style="width:100%;">
            <canvas id="mostOrderedService" style="display: block; height: 750px; width: 1127px;"
                class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

@endsection


@section("assets")
<script>
    $.ajax({
        url: "{{ url('/dashboard/branch/mostOrderedService') }}",
        success: function (res) {
            var config = {
                type: 'bar',
                data: {
                    labels: ["عدد مرات الطلب"],
                    datasets: []
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'مخطط عدد مرات طلب الخدمة'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    },
                }
            };
            var services = res.services;
            for (let i = 0; i < services.length; i++) {
                config.data.datasets.push({
                    label: services[i].name,
                    backgroundColor: [getRandomColor(i)],
                    data: [
                        services[i].order_count
                    ],
                });
            }

            var ctx = document.getElementById('mostOrderedService').getContext('2d');
            window.myLine = new Chart(ctx, config);
        }
    })

</script>
@endsection
