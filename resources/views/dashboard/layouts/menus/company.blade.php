<li class="{{ c_page(['companies_management']) }}">
    <a href="{{ url('/dashboard/company') }}">
        <span class="title"> <i class="clip-info-2"></i>
            {{ __("dashboard.companyInfo") }} </span>
    </a>
</li>


<li class="{{ c_page(['branches_management']) }}">
    <a href="{{ url('/dashboard/branches') }}">
        <span class="title"> <i class="fa fa-flag"></i>
            {{ __("dashboard.branches") }} </span>
    </a>
</li>

