<li class="{{ c_page('admin_management') }}">
    <a href="{{ url('/dashboard/admins') }}">
        <span class="title"> <i class="fa fa-users"></i>
            {{ __("dashboard.admins") }} </span>
    </a>
</li>

<li class="{{ c_page(['companies_management']) }}">
    <a href="{{ url('dashboard/companies') }}"><i class="fa fa-flag"></i>
        <span class="title"> {{ __("dashboard.companies_management") }} </span>
    </a>
</li>

<li class="{{ c_page('constant_management') }}">
    <a href="{{ url('/dashboard/constants') }}">
        <span class="title"> <i class="clip-cogs"></i>
            {{ __("dashboard.constant_management") }} </span>
    </a>
</li>




