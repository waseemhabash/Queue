<!DOCTYPE html>
<html lang="en">

<head>
    <title> {{ $branch->name }} - الطابور</title>
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
    <link rel="shortcut icon" href="{{ url("/favicon.png") }}" />

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
                                <th class="column3">النافذة</th>
                            </tr>
                        </thead>
                        <tbody id="queue_tbody">

                            @foreach ($branch->current_queue(10) as $queue)
                            <tr>
                                <td class="column1 c">{{ $queue->number }}</td>
                                <td class="column2 c">{{ $queue->service->name }}</td>
                                <td class="column3 c">{{ $queue->employee ? $queue->employee->window->prefix : "----" }}
                                </td>

                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>




    <input hidden value="{{ $branch }}" id="branch">

    <script src="{{ url('/') }}/assets/site/employee/index/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/vendor/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/index/js/main.js"></script>
    <script src="{{ url('/') }}/js/socketio.js"></script>
    <script>
        var socket = io.connect("localhost:3000");
        var branch = JSON.parse($("#branch").val());
        socket.emit("add_to_branch", branch.id);

        socket.on("update_queue", function (data) {

            var queue = JSON.parse(data.queue);
            var content = "";

            queue.forEach(element => {
                content += `
                <tr>
                    <td class="column1 c">` + element.number + `</td>
                    <td class="column2 c">` + element.service.name + `</td>
                    <td class="column3 c">` + ((element.employee == null) ? '----' : element.employee.window.prefix) + `</td>
                </tr>
                `;
            });

            $("#queue_tbody").html(content);

        });

        socket.on("calling", function (data) {
            var link = data.full_voice_file_link;

            var wait = parseInt(data.wait);
            setTimeout(function () {
                var audio = new Audio(link);
                audio.play();
            }, wait * 1000)

            setTimeout(function () {
                $.ajax({
                    url: "{{ url('screen/delete_call') }}",
                    data: data
                });
            }, (wait + 5.25) * 1000);
        });

    </script>
</body>

</html>
