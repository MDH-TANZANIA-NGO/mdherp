<div class="app-header header top-header comb-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
            <a class="header-brand" href="">
               <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img desktop-lgo" alt="MDH logo">
               <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img dark-logo" alt="MDH logo">
               <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img mobile-logo" alt="MDH logo">
               <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img darkmobile-logo" alt="MDH logo">
            </a>
            <div class="dropdown   side-nav" >
                <a aria-label="Hide Sidebar" class="app-sidebar__toggle nav-link icon mt-1" data-toggle="sidebar" href="#">
                    <i class="fe fe-align-left"></i>
                </a><!-- sidebar-toggle-->
            </div>




            <div class="d-flex order-lg-2 ml-auto">
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>
                <div class="mt-1">
                    {{--<form class="form-inline">
                        <div class="search-element">
                            <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
                            <button class="btn btn-primary-color" type="submit"><i class="fa fa-search text-dark"></i></button>
                        </div>
                    </form>--}}
                </div><!-- SEARCH -->



                <div class="dropdown ">

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                        <div class="text-center">

                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <a href="#" class="dropdown-item text-center user pb-0">{{ access()->user()->full_name_formatted }}</a>
                        <span class="text-center user-semi-title text-dark">{{{access()->user()->email}}}</span>
                        <div class="dropdown-divider"></div>


                        @endguest


                        </div>
                        <a class="dropdown-item" href="{{route('userbio.create')}}">
                            <i class="dropdown-icon mdi mdi-account-outline "></i> My Biography
                        </a>

                        {{-- <a class="dropdown-item" href="#">
                            <i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
                        </a> --}}

                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

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
