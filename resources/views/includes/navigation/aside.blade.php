<aside class="app-sidebar comb-sidebar">
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
    
            <div class="sidebar-navs mt-3">
                <ul class="nav nav-pills nav-pills-circle" id="tabs_3" role="tablist">
{{--                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Settings">--}}
{{--                        <a class="nav-link border h-6 text-center m-2" id="tab21" data-toggle="tab" href="#tabs_2_1" role="tab" >--}}
{{--                            <i class="fe fe-settings"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Chat">--}}
{{--                        <a class="nav-link border h-6  m-2" id="tab22" data-toggle="tab" href="#tabs_2_2" role="tab" >--}}
{{--                            <i class="fe fe-mail"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                
                </ul>
            </div>
        </div>
    </div>
    <ul class="side-menu">
        <li>
            <a class="side-menu__item" href="{{ route('workspace.invoke') }}"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Workspace</span></a>
        </li>
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
    </ul>
</aside>
