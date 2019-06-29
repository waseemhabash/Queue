<li class="{{ c_page(['branches_management']) }}">
    <a href="{{ url('/dashboard/branch') }}">
        <span class="title"> <i class="clip-info-2"></i>
            {{ __("dashboard.branchInfo") }} </span>
    </a>
</li>





<li class="{{ c_page(['employees_management']) }}">
    <a href="{{ url('/dashboard/employees') }}">
        <span class="title"> <i class=" clip-user-5"></i>
            {{ __("dashboard.employees_management") }} </span>
    </a>
</li>
<li class="{{ c_page(['services_management']) }}">
    <a href="{{ url('/dashboard/services') }}">
        <span class="title"> <i class="clip-stack-empty"></i>
            {{ __("dashboard.services_management") }} </span>
    </a>
</li>
<li class="{{ c_page(['ticketsEmployees_management']) }}">
    <a href="{{ url('/dashboard/tickets-employees') }}">
        <span class="title"> <i class="fa fa-credit-card"></i>
            {{ __("dashboard.ticketsEmployees_management") }} </span>
    </a>
</li>
<li class="{{ c_page(['windows_management']) }}">
    <a href="{{ url('/dashboard/windows') }}">
        <span class="title"> <i class="fa fa-bullhorn"></i>
            {{ __("dashboard.windows_management") }} </span>
    </a>
</li>

<li>
    <a href="{{ url('/branch/screen') }}">
        <span class="title"> <i class="fa fa-desktop"></i>
            {{ __("dashboard.screen") }} </span>
    </a>
</li>





