@extends('dashboard.layouts.index')

@section('content')

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div style="width:100%;">

            <canvas id="homeStatistic" style="display: block; height: 563px; width: 1127px;"
                class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

@endsection

@section("assets")
<script>
    $.ajax({
        url: "{{ url('/dashboard/admin/homeStatistic') }}",
        success: function (res) {
            var config = {
                type: 'bar',
                data: {
                    labels: ["عدد الفروع"],
                    datasets: []
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: ' عدد الفروع ضمن الشركات'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                stepSize: 1
                            }
                        }]
                    },
                }
            };
            var companies = res.companies;
            for (let i = 0; i < companies.length; i++) {
                config.data.datasets.push({
                    label: companies[i].name,
                    backgroundColor: [getRandomColor(i)],
                    data: [
                        companies[i].branches
                    ],
                });
            }

            var ctx = document.getElementById('homeStatistic').getContext('2d');
            window.myLine = new Chart(ctx, config);
        }
    })
</script>
@endsection
