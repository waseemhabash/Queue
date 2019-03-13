<body class="rtl">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    {{ __("dashboard.brand") }}
                </a>
            </div>
            <div class="navbar-tools">
                <ul class="nav navbar-right">

                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true"
                            href="#">

                            <span class="username">{{ auth()->user()->name }}</span>
                            <i class="clip-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="pages_user_profile.html">
                                    <i class="clip-user-2"></i>
                                    &nbsp;My Profile
                                </a>
                            </li>


                            <li class="divider"></li>

                            <li>
                                <a href="{{ url('dashboard/logout') }}">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="navbar-content">
            <div class="main-navigation navbar-collapse collapse">
                <div class="navigation-toggler">
                    <i class="clip-chevron-left"></i>
                    <i class="clip-chevron-right"></i>
                </div>
                <ul class="main-navigation-menu">
                    <li class="{{ c_page('home') }}">
                        <a href="{{ url('dashboard') }}"><i class="clip-home-3"></i>
                            <span class="title"> {{ __("dashboard.home") }} </span>
                        </a>
                    </li>


                    @if (is_type("admin"))

                    <li class="{{ c_page('admin_management') }}">
                        <a href="{{ url('/dashboard/admins') }}">
                            <span class="title"> <i class="fa fa-users"></i>
                                {{ __("dashboard.admins") }} </span>
                        </a>
                    </li>
                    @endif

                    @if (is_type("admin"))
                    <li class="{{ c_page(['companies_management','branches_management','services_management','windows_management','employees_management']) }}">
                        <a href="{{ url('dashboard/companies') }}"><i class="fa fa-flag"></i>
                            <span class="title"> {{ __("dashboard.companies_management") }} </span>
                        </a>
                    </li>
                    @endif

                    @if (is_type("admin"))

                    <li class="{{ c_page('constant_management') }}">
                        <a href="{{ url('/dashboard/constants') }}">
                            <span class="title"> <i class="clip-cogs"></i>
                                {{ __("dashboard.constant_management") }} </span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <ol class="breadcrumb">
                        <li class="search-box">
                            <form class="sidebar-search" method="get" action="{{ url()->current() }}">
                                <div class="form-group">
                                    <input type="text" placeholder="{{ __('dashboard.search') }}" name="search">
                                    <button class="submit">
                                        <i class="clip-search-3"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ol>
                    <div class="page-header">
                        <h1>{{ __("dashboard.".session("c_page")) }}</h1>
                    </div>
                </div>
            </div>
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
