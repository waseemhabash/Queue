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
                        <tbody id="queue_tbody">

                            @foreach ($branch->current_queue(10) as $queue)
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
                    @if(is_null($employee->startServedButNotFinished()))

                    <button class="btn btn-success text-center" id="call_btn">
                        طلب الاسم التالي <i class="fa fa-volume-up" id="call_icon"></i>
                        ({{ $employee->next_in_queue()->number ?? "لا يوجد" }})
                    </button>

                    @if ($employee->calledAndNotServed())
                    <a href="{{ url('/employee/start_service') }}">
                        <button class="btn btn-info text-center ">
                            بدء الخدمة <i class="fa fa-arrow-left"></i>
                            ({{ $employee->next_in_queue()->number ?? "لا يوجد" }})
                        </button>
                    </a>

                    <a href="{{ url('/employee/skip') }}">
                        <button class="btn btn-danger text-center" id="skip-button">
                            تخطي <i class="fa fa-ban"></i> ({{ $employee->next_in_queue()->number ?? "لا يوجد" }})
                        </button>
                    </a>
                    @endif


                </center>
                @else
                <a href="{{ url('/employee/end_service') }}">
                    <button class="btn btn-primary text-center">
                        إنهاء الخدمة <i class="fa fa-check"></i> ({{ $employee->startServedButNotFinished()->number }})
                    </button>
                </a>
                @endif

            </div>
        </div>
    </div>


    <input hidden value="{{ $branch }}" id="branch">

    <script src="{{ url('/') }}/assets/site/employee/index/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/js/main.js"></script>
    <script src="{{ url('/') }}/assets/site/js/socketio.js"></script>


    <script>
        var socket = io.connect("localhost:3000");
        var branch = JSON.parse($("#branch").val());
        socket.emit("add_to_branch", branch.id);
        socket.on("update_queue", function (data) {
            window.location.reload();
        });

        $("#call_btn").click(function (e) {
            e.preventDefault();

            $(this).attr("disabled", "true");
            $("#call_icon").removeClass("fa-volume-up").addClass("fa-spinner").addClass("fa-spin");
            var wait = 0;
            var state = 0;

            $.ajax({
                url: "{{ url('employee/check_call') }}",
                success: function (res) {

                    if (res.state) {
                        
                        wait = (res.wait + 5 ) * 1000;
                        state = 1;
                    } else {
                        if(res.code == 2)
                        {
                            alert("لا يوجد أحد يمكنك تخدميه في المركز");
                        state = 2;
                        }else if(res.code == 3)
                        {
                            alert("لقد قمت بالفعل بطلب الزبون التالي !!");
                            window.location.reload();
                        }
                        

                    }
                },
            }).then(function () {
                if (state == 1) {
                    setTimeout(function () {
                        window.location.reload();
                    }, wait);
                }

            });
        });

    </script>
</body>

</html>
