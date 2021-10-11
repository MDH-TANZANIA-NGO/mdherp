<aside class="app-sidebar comb-sidebar">

    <ul class="side-menu">

        <li>
            <a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Workspace</span></a>
        </li>

        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-inbox"></i><span class="side-menu__label">Incoming Requests</span></a></li>
        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Responded Requests</span></a></li>
        <li><a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Actioned Request</span></a></li>

        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">User Management</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="{{ route('user.index') }}"><span>Staff</span></a></li>
{{--                <li><a class="slide-item" href="index2.html"><span>Dashboard 02</span></a></li>--}}
{{--                <li><a class="slide-item" href="index3.html"><span>Dashboard 03</span></a></li>--}}
{{--                <li><a class="slide-item" href="index4.html"><span>Dashboard 04</span></a></li>--}}
{{--                <li><a class="slide-item" href="index5.html"><span>Dashboard 05</span></a></li>--}}
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="#"><span>Budget</span></a></li>
                <li><a class="slide-item"  href="#"><span>Activities</span></a></li>
                <li><a class="slide-item"  href="#"><span>Travel</span></a></li>
            </ul>
        </li>

    </ul>
</aside>
