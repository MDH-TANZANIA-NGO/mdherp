<aside class="app-sidebar comb-sidebar">

    <ul class="side-menu">

        <li>
            <a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Workspace</span></a>
        </li>

        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon ion-archive"></i><span class="side-menu__label">Incoming Requests</span></a></li>
        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon ion-reply"></i><span class="side-menu__label">Responded Requests</span></a></li>
        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon ion-reply-all"></i><span class="side-menu__label">Actioned Request</span></a></li>

        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">User Management</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('user.index') }}"><span>List</span></a></li>
                <li><a class="slide-item"  href="{{ route('user.create') }}"><span>Register</span></a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">System Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href=""><span>Roles</span></a></li>
                <li><a class="slide-item"  href="#"><span>Permissions</span></a></li>
{{--                <li><a class="slide-item"  href="#"><span>Workflow</span></a></li>--}}
                <li><a class="slide-item"  href="#"><span>Perdiem Rates</span></a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-activity"></i><span class="side-menu__label">Project Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('project.index') }}"><span>Project</span></a></li>
                <li><a class="slide-item"  href="{{ route('program_area.index') }}"><span>Program Area</span></a></li>
                <li><a class="slide-item"  href="{{ route('sub_program.index') }}"><span>Sub Program</span></a></li>
                <li><a class="slide-item"  href="{{ route('activity.index') }}"><span>Activities</span></a></li>
                <li><a class="slide-item"  href="{{ route('output_unit.index') }}"><span>Output Units</span></a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-credit-card"></i><span class="side-menu__label">Budget Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href=""><span>Fiscal Year</span></a></li>
                <li><a class="slide-item"  href="{{route('userregister')}}"><span>Budget</span></a></li>

            </ul>
        </li>

    </ul>
</aside>
