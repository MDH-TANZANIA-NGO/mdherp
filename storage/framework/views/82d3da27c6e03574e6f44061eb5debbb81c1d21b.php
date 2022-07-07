<aside class="app-sidebar comb-sidebar">

    <ul class="side-menu">

        <li>
            <a class="side-menu__item" href="<?php echo e(route('workspace.invoke')); ?>"><i class="side-menu__icon fe fe-monitor"></i><span class="side-menu__label">Workspace</span></a>
        </li>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'workflow_participant')): ?>
        <li><a class="side-menu__item" href="<?php echo e(route('workflow.new')); ?>"><i class="side-menu__icon ion-archive"></i><span class="side-menu__label">Incoming Requests</span>  <?php echo e($workflow_navigation->getNewQueryCount()); ?> </a></li>
        <li><a class="side-menu__item" href="<?php echo e(route('workflow.responded')); ?>"><i class="side-menu__icon ion-reply"></i><span class="side-menu__label">Responded Requests</span>  <?php echo e($workflow_navigation->RespondedQueryCount()); ?> </a></li>
        <li><a class="side-menu__item" href="<?php echo e(route('workflow.attended')); ?>"><i class="side-menu__icon ion-reply-all"></i><span class="side-menu__label">Actioned Request</span>  <?php echo e($workflow_navigation->MyAttendedCount()); ?> </a></li>
        <?php endif; ?>


        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'user_management')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Internal User</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('user.index')); ?>"><span>List</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('user.create')); ?>"><span>Register</span></a></li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'external_user_management')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">External User </span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('g_officer.create')); ?>"><span>Register</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('g_officer.bulk_update')); ?>"><span>Bulk Update</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('g_officer.index')); ?>"><span>List</span></a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'project_settings')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-wrench"></i><span class="side-menu__label">Project Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('project.index')); ?>"><span>Project</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('program_area.index')); ?>"><span>Program Area</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('sub_program.index')); ?>"><span>Sub Program</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('activity.index')); ?>"><span>Activities</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('output_unit.index')); ?>"><span>Output Units</span></a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'budget_settings')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fe fe-credit-card"></i><span class="side-menu__label">Budget Settings</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('fiscal_year.index')); ?>"><span>Fiscal Year</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('budget.index')); ?>"><span>Budget</span></a></li>

            </ul>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'finance_activity')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-dollar"></i><span class="side-menu__label">Finance Activities</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('finance.index')); ?>"><span>Payments</span></a></li>
                <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'financial_report')): ?>
                <li><a class="slide-item"  href="<?php echo e(route('financial-report.index')); ?>"><span>Financial Reports</span></a></li>
                <?php endif; ?>

                <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'exchange_rate_setting')): ?>
                <li><a class="slide-item"  href="<?php echo e(route('rate.index')); ?>"><span>Exchange Rate</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'general_settings')): ?>
        <li class="">
            <a class="side-menu__item" href="<?php echo e(route('general.invoke')); ?>"><i class="side-menu__icon fa fa-cogs"></i><span class="side-menu__label">General Settings</span></a>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'audit_trail')): ?>
        <li class="">
            <a class="side-menu__item" href=""><i class="side-menu__icon fa fa-history"></i><span class="side-menu__label">Audit Trail</span></a>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'hr_dashboard')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-handshake-o multiple-outline text-primary"></i><span class="side-menu__label">HR Dashboard</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('leave_report.index')); ?>"><span>Leave Reports</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('timesheet_report.index')); ?>"><span>Timesheet Reports</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('employee.index')); ?>"><span>Employees</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('designation.create')); ?>"><span>Add Designation</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('job_management.index')); ?>"><span>Jobs Management</span></a></li>
                <li><a class="slide-item"  href="<?php echo e(route('induction_schedule.index')); ?>"><span>Induction Schedules</span></a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'admin_panel')): ?>
        <li class="slide">
            <a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon fa fa-street-view multiple-outline text-primary"></i><span class="side-menu__label">Admin Panel</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item"  href="<?php echo e(route('admin.workspace')); ?>"><span>Hotels</span></a></li>
            </ul>
        </li>
        <?php endif; ?>
       

    </ul>
</aside>
<?php /**PATH /Users/william/Code/mdherp/resources/views/includes/navigation/aside.blade.php ENDPATH**/ ?>