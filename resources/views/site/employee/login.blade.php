<!DOCTYPE html>
<html>

<head>
    <title>تسجيل الدخول</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/') }}/assets/site/employee/login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/site/employee/login/css/main.css">
    <link rel="shortcut icon" href="{{ url("/favicon.png") }}" />

</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ url('/') }}/assets/site/employee/login/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ url('employee/login') }}">
                    @csrf
                    <span class="login100-form-title">
                        تسجيل الدخول
                    </span>
                    @if (session("success"))
                    {{ alert_box("success",session("success")) }}
                    @endif

                    @if (session("error"))
                    {{ alert_box("danger",session("error")) }}
                    @endif


                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="email" name="email" placeholder="البريد الإلكتروني" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password" name="password" placeholder="كلمة المرور" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            تسجيل الدخول
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">

                        </span>
                        <a class="txt2" href="#">

                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">

                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('/') }}/assets/site/employee/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/login/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/login/vendor/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script src="{{ url('/') }}/assets/site/employee/login/js/main.js"></script>

</body>

</html>
