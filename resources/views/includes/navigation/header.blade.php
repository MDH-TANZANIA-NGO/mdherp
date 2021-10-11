<div class="app-header header top-header comb-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
            <a class="header-brand" href="index.html">
                <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img desktop-lgo" alt="{{ config("app.name") }}">
                <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img dark-logo" alt="{{ config("app.name") }}">
                <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img mobile-logo" alt="{{ config("app.name") }}">
                <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img darkmobile-logo" alt="{{ config("app.name") }}">
            </a>
            <div class="dropdown   side-nav" >
                <a aria-label="Hide Sidebar" class="app-sidebar__toggle nav-link icon mt-1" data-toggle="sidebar" href="#">
                    <i class="fe fe-align-left"></i>
                </a><!-- sidebar-toggle-->
            </div>
{{--            <div class="dropdown  header-option">--}}
{{--                <a class="nav-link icon" data-toggle="dropdown">--}}
{{--                    <i class="fe fe-codepen"></i> <span class="nav-span">Projects <i class="fa fa-angle-down ml-1 fs-18"></i></span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        App Design Projects--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Web Design Projects--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        App Development Projects--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Back-End Projects--}}
{{--                    </a>--}}
{{--                    <div class="text-left pr-5 pl-5 p-2 border-top">--}}
{{--                        <a href="#" class="">View Projects</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="dropdown   header-setting">--}}
{{--                <a class="nav-link icon" data-toggle="dropdown">--}}
{{--                    <i class="fe fe-settings"></i><span class="nav-span">Settings <i class="fa fa-angle-down ml-1 fs-18"></i></span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Multi Pages--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Mail Settings--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Default Settings--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        Documentation--}}
{{--                    </a>--}}
{{--                    <div class="text-left pr-5 pl-5 p-2  border-top">--}}
{{--                        <a href="#" class="">Updated</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="d-flex order-lg-2 ml-auto">
{{--                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>--}}
{{--                <div class="mt-1">--}}
{{--                    <form class="form-inline">--}}
{{--                        <div class="search-element">--}}
{{--                            <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">--}}
{{--                            <button class="btn btn-primary-color" type="submit"><i class="fa fa-search text-dark"></i></button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div><!-- SEARCH -->--}}

                <div class="dropdown   header-fullscreen" >
                    <a  class="nav-link icon full-screen-link"  id="fullscreen-button">
                        <i class="fe fe-minimize"></i>
                    </a>
                </div>
{{--                <div class="dropdown    header-notify">--}}
{{--                    <a class="nav-link icon" data-toggle="dropdown">--}}
{{--                        <i class="fe fe-bell"></i>--}}
{{--                        <span class="pulse "></span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
{{--                        <a href="#" class="dropdown-item d-flex pb-3">--}}
{{--                            <div class="notifyimg">--}}
{{--                                <i class="fe fe-message-square"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div>Message Sent.</div>--}}
{{--                                <div class="small text-muted">3 hours ago</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="dropdown-item d-flex pb-3">--}}
{{--                            <div class="notifyimg bg-danger">--}}
{{--                                <i class="fe fe-shopping-cart"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div> Order Placed</div>--}}
{{--                                <div class="small text-muted">5  hour ago</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="dropdown-item d-flex pb-3">--}}
{{--                            <div class="notifyimg bg-success">--}}
{{--                                <i class="fe fe-calendar"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div> Event Started</div>--}}
{{--                                <div class="small text-muted">45 mintues ago</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="dropdown-item d-flex pb-3">--}}
{{--                            <div class="notifyimg bg-warning">--}}
{{--                                <i class="fe fe-airplay"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div>Your Admin lanuched</div>--}}
{{--                                <div class="small text-muted">1 daya ago</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <div class=" text-center p-2 border-top">--}}
{{--                            <a href="#" class="">View All Notifications</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="dropdown ">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
										<span>
											<img src="mdh/images/users/16.jpg" alt="img" class="avatar avatar-md brround">
										</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                        <div class="text-center">
                            <a href="#" class="dropdown-item text-center user pb-0">{{ access()->user()->full_name_formatted }}</a>
                            <span class="text-center user-semi-title text-dark">App Developer</span>
                            <div class="dropdown-divider"></div>
                        </div>
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon mdi mdi-account-outline "></i> Profile
                        </a>
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <i class="dropdown-icon  mdi mdi-settings"></i> Settings--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message--}}
{{--                        </a>--}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
