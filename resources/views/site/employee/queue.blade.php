<!DOCTYPE html>
<html lang="en">

<head>
    <title> {{ auth()->user()->employee->branch->name }} - الطابور</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/index/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/index/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/index/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/index/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/index/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/index/css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table>
                        <thead>
                            <tr class="table100-head">

                                <th class="column1">الرقم</th>
                                <th class="column2">الخدمة</th>
                                <th class="column2">وقت الوصول</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($branch->current_queue() as $queue)
                            <tr>
                                <td class="column1 c">{{ $queue->number }}</td>
                                <td class="column2 c">{{ $queue->service->name }}</td>
                                <td class="column3 c">{{ $queue->created_at->format("H:i") }}</td>

                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
                <center>
                    <br>
                    <button class="btn btn-success text-center"> الزبون التالي <i class="fa fa-arrow-left"></i></button>
                </center>

            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/assets/site/employee/index/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/js/main.js"></script>

</body>

</html>
