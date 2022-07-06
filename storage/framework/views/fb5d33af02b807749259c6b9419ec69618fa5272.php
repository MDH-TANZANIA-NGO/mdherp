<div class="app-header header top-header comb-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
            <a class="header-brand" href="<?php echo e(route('workspace.invoke')); ?>">
               <img src="<?php echo e(asset('mdh/images/brand/logo.png')); ?>" class="header-brand-img desktop-lgo" alt="MDH logo">
               <img src="<?php echo e(asset('mdh/images/brand/logo.png')); ?>" class="header-brand-img dark-logo" alt="MDH logo">
               <img src="<?php echo e(asset('mdh/images/brand/logo.png')); ?>" class="header-brand-img mobile-logo" alt="MDH logo">
               <img src="<?php echo e(asset('mdh/images/brand/logo.png')); ?>" class="header-brand-img darkmobile-logo" alt="MDH logo">
            </a>
            <div class="dropdown   side-nav" >
                <a aria-label="Hide Sidebar" class="app-sidebar__toggle nav-link icon mt-1" data-toggle="sidebar" href="#">
                    <i class="fe fe-align-left"></i>
                </a><!-- sidebar-toggle-->
            </div>

            
            <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'online_checkin')): ?>
                   <div class="dropdown  header-option">
                    <a class="nav-link icon">
                        <i class="fe fe-clock"></i> <span class="nav-span">Check In</span>
                    </a>
                   </div>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'business_requisitions')): ?>
            <div class="dropdown  header-option">
                <a class="nav-link icon" href="<?php echo e(route('requisition.all_requisitions')); ?>">
                    <i class="fe fe-file-text"></i> <span class="nav-span">Requisitions</span>
                </a>
            </div>
            <?php endif; ?>
                <div class="dropdown  header-option" >
                    <a class="nav-link icon" href="<?php echo e(route('g_officer.index')); ?>">
                        <i class="fe fe-users"></i> <span class="nav-span">Beneficiaries</span>
                    </a>
                </div>
                <div class="dropdown  header-option" >
                    <a class="nav-link icon" href="<?php echo e(route('interview.showPanelistJobs')); ?>">
                        <i class="fe fe-users"></i> <span class="nav-span">Panelists</span>
                    </a>
                </div>


            <div class="d-flex order-lg-2 ml-auto">
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>
                <div class="mt-1">
                    
                </div><!-- SEARCH -->

                <div class="dropdown   header-fullscreen" >
                    <a  class="nav-link icon full-screen-link"  id="fullscreen-button">
                        <i class="fe fe-minimize"></i>
                    </a>
                </div>
                
                <div class="dropdown ">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
										<span>
                                             <?php if(access()->user()->getMedia('profile_pic')->first() != null): ?>
                                                <img src="<?php echo e(access()->user()->getMedia('profile_pic')->first()->getUrl()); ?>" alt="img" class="avatar avatar-md brround">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('mdh/images/users/16.jpg')); ?>" alt="img" class="avatar avatar-md brround">
                                            <?php endif; ?>

										</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                        <div class="text-center">

                            <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>

                        <a href="#" class="dropdown-item text-center user pb-0"><?php echo e(access()->user()->full_name_formatted); ?></a>
                        <span class="text-center user-semi-title text-dark"><?php echo e(access()->user()->email); ?></span>
                        <div class="dropdown-divider"></div>


                        <?php endif; ?>


                        </div>
                        <a class="dropdown-item" href="<?php echo e(route('userbio.create')); ?>">
                            <i class="dropdown-icon mdi mdi-account-outline "></i> My Biography
                        </a>

                        

                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/includes/navigation/header.blade.php ENDPATH**/ ?>