@php
	$login_user = login_user();
@endphp

<body class="rtl">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/dashboard/home') }}">
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
                    <li class="active open">
                        <a href="index.html"><i class="clip-home-3"></i>
                            <span class="title"> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="clip-screen"></i>
                            <span class="title"> Layouts </span><i class="icon-arrow"></i>

                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="layouts_horizontal_menu1.html">
                                    <span class="title"> Horizontal Menu </span>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-content">

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <ol class="breadcrumb">
                            <li class="search-box">
                                <form class="sidebar-search">
                                    <div class="form-group">
                                        <input type="text" placeholder="Start Searching...">
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
