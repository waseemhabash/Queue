@extends('dashboard.layouts.index')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div style="width:100%;">

            <canvas id="rateBranchStatistic" style="display: block; height: 750px; width: 1127px;"
                class="chartjs-render-monitor"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div style="width:100%;">

            <canvas id="customerBranchPieStatistic" style="display: block; height: 563px; width: 1127px;"
                class="chartjs-render-monitor"></canvas>
        </div>
    </div>

</div>



@endsection


@section("assets")
<script>
    $(function () {

        $.ajax({
            url: "{{ url('/dashboard/company/rateBranchStatistic') }}",
            success: function (res) {
                var config = {
                    type: 'bar',
                    data: {
                        labels: ["تقييم الفرع"],
                        datasets: []
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: ' التقييمات الزبائن على خدمات الفرع'
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
                            branches[i].rate
                        ],
                    });
                }
                var ctx = document.getElementById('rateBranchStatistic').getContext('2d');
                new Chart(ctx, config);

            }
        });

        $.ajax({
            url: "{{ url('/dashboard/company/customerBranchPieStatistic') }}",
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
                            text: 'عدد الزبائن بالأفرع بالنسبة لعدد الزبائن الكلي'
                        },
                        responsive: true
                    },
                };

                var branches = res.branches;
                var dataset = config.data.datasets[0];
                for (let i = 0; i < branches.length; i++) {
                    dataset.data.push(Math.round(branches[i].customers * 100));
                    config.data.labels.push(branches[i].name);
                    dataset.backgroundColor.push(getRandomColor(i));
                }
                var ctx = document.getElementById('customerBranchPieStatistic').getContext('2d');
                new Chart(ctx, config);
            }
        });
    });

</script>
@endsection
