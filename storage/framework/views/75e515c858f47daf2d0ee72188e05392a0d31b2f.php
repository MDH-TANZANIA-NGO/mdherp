
<?php $__env->startSection('content'); ?>
  
    <div class="card-body p-6">
        <div class="panel panel-primary">
            <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
                <div class="tabs-menu1 " >
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class=""><a href="#tab5" class="active" data-toggle="tab">Active  <span class="badge badge-success"><?php echo e($active_user_count); ?></span></a></li>
                        <li><a href="#tab6" data-toggle="tab" class="">Inactive <span class="badge badge-danger"><?php echo e($inactive_user_count); ?></span></a></li>
                    </ul>
                </div>

                <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                    <div class="btn-group mb-0">
                        <a href="<?php echo e(route('user.create')); ?>"> <i class="fa fa-user-plus mr-2"></i>Add Staff</a>
                    </div>
                </div>

            </div>
            <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="active_users" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">First name</th>
                                        <th class="wd-15p">Last name</th>
                                        <th class="wd-20p">Email</th>
                                        <th class="wd-20p">Position</th>
                                        <th class="wd-15p">Region</th>
                                        <th class="wd-10p">Projects</th>
                                        <th class="wd-25p">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab6">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="inactive_users" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">First name</th>
                                        <th class="wd-15p">Last name</th>
                                        <th class="wd-20p">Email</th>
                                        <th class="wd-20p">Position</th>
                                        <th class="wd-15p">Region</th>
                                        <th class="wd-10p">Projects</th>
                                        <th class="wd-25p"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {

            $("#active_users").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('employee.datatable.active')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'first_name', name: 'users.first_name', searchable: true},
                    { data: 'last_name', name: 'users.last_name', searchable: true},
                    { data: 'email', name: 'users.email', searchable: true},
                    { data: 'designation', name: 'unit.name', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'project_list', name: 'projects.title', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

            $("#inactive_users").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('employee.datatable.inactive')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'first_name', name: 'users.first_name', searchable: true},
                    { data: 'last_name', name: 'users.last_name', searchable: true},
                    { data: 'email', name: 'users.email', searchable: true},
                    { data: 'designation', name: 'unit.name', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'project_list', name: 'projects.title', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/user/index.blade.php ENDPATH**/ ?>