<aside class="app-sidebar comb-sidebar">

    <ul class="side-menu">

        <li>
            <a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Workspace</span></a>
        </li>

        @permission('workflow_participant')
        <li><a class="side-menu__item" href="{{ route('workflow.new') }}"><i class="side-menu__icon ion-archive"></i><span class="side-menu__label">Incoming Requests</span>  {{ $workflow_navigation->getNewQueryCount() }} </a></li>
        <li><a class="side-menu__item" href="{{ route('workflow.responded') }}"><i class="side-menu__icon ion-reply"></i><span class="side-menu__label">Responded Requests</span>  {{ $workflow_navigation->RespondedQueryCount()}} </a></li>
        <li><a class="side-menu__item" href="{{ route('workflow.attended') }}"><i class="side-menu__icon ion-reply-all"></i><span class="side-menu__label">Actioned Request</span>  {{ $workflow_navigation->MyAttendedCount() }} </a></li>
        @endpermission


        @permission('user_management')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">User Management</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('user.index') }}"><span>List</span></a></li>
                <li><a class="slide-item"  href="{{ route('user.create') }}"><span>Register</span></a></li>
                <li><a class="slide-item"  href="{{ route('g_officer.index') }}"><span>External users</span></a></li>
            </ul>
        </li>
        @endpermission

        @permission('project_settings')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-wrench"></i><span class="side-menu__label">Project Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('project.index') }}"><span>Project</span></a></li>
                <li><a class="slide-item"  href="{{ route('program_area.index') }}"><span>Program Area</span></a></li>
                <li><a class="slide-item"  href="{{ route('sub_program.index') }}"><span>Sub Program</span></a></li>
                <li><a class="slide-item"  href="{{ route('activity.index') }}"><span>Activities</span></a></li>
                <li><a class="slide-item"  href="{{ route('output_unit.index') }}"><span>Output Units</span></a></li>
            </ul>
        </li>
        @endpermission

        @permission('budget_settings')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-credit-card"></i><span class="side-menu__label">Budget Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('fiscal_year.index') }}"><span>Fiscal Year</span></a></li>
                <li><a class="slide-item"  href="{{ route('budget.index') }}"><span>Budget</span></a></li>

            </ul>
        </li>
        @endpermission

        @permission('finance_activity')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-dollar"></i><span class="side-menu__label">Finance Activities</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('finance.index') }}"><span>Payments</span></a></li>
                @permission('financial_report')
                <li><a class="slide-item"  href="{{ route('financial-report.index') }}"><span>Financial Reports</span></a></li>
                @endpermission

                @permission('exchange_rate_setting')
                <li><a class="slide-item"  href="{{ route('rate.index') }}"><span>Exchange Rate</span></a></li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('general_settings')
        <li class="">
            <a class="side-menu__item" href="{{ route('general.invoke') }}"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">General Settings</span></a>
        </li>
        @endpermission

        @permission('audit_trail')
        <li class="">
            <a class="side-menu__item" href=""><i class="side-menu__icon fa fa-history"></i><span class="side-menu__label">Audit Trail</span></a>
        </li>
        @endpermission

        @permission('hr_dashboard')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-handshake-o multiple-outline text-primary"></i><span class="side-menu__label">HR Dashboard</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('leave_report.index') }}"><span>Leave Reports</span></a></li>
                <li><a class="slide-item"  href="{{ route('timesheet_report.index') }}"><span>Timesheet Reports</span></a></li>
                <li><a class="slide-item"  href="{{ route('employee.index') }}"><span>Employees</span></a></li>
            </ul>
        </li>
        @endpermission

        @permission('compliance')
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-database multiple-outline text-primary"></i><span class="side-menu__label">Compliance</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                   <li><a class="slide-item"  href="{{ route('compliance.index') }}"><span>Beneficiaries List</span></a></li>
            </ul>
        </li>
        @endpermission

    </ul>
</aside>
