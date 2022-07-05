<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">On Process <span class="badge badge-warning"><?php echo e($leaves->getSubmittedLeaves()->count()); ?></span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned for Modification <span class="badge badge-danger"><?php echo e($leaves->getRejectedLeaves()->count()); ?></span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success"><?php echo e($leaves->getApprovedLeaves()->count()); ?></span></a></li>
                </ul>
            </div>

        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="processing">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REQUESTER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">COMMENT</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="saved">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_saved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REQUESTER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">COMMENT</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="approved">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_approved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REQUESTER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">COMMENT</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="rejected">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_rejected" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REQUESTER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">COMMENT</th>
                                    <th class="wd-25p">ACTION</th>
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

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {

            $("#access_processing").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('leave_report.submitted')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'type_name', name: 'leave_types.name', searchable: true},
                    { data: 'start_date', name: 'leaves.start_date', searchable: true},
                    { data: 'end_date', name: 'leaves.end_date', searchable: true },
                    { data: 'comment', name: 'leaves.comment', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_rejected").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('leave_report.rejected')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'type_name', name: 'leave_types.name', searchable: true},
                    { data: 'start_date', name: 'leaves.start_date', searchable: true},
                    { data: 'end_date', name: 'leaves.end_date', searchable: true },
                    { data: 'comment', name: 'leaves.comment', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_approved").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('leave_report.approved')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'type_name', name: 'leave_types.name', searchable: true},
                    { data: 'start_date', name: 'leaves.start_date', searchable: true},
                    { data: 'end_date', name: 'leaves.end_date', searchable: true },
                    { data: 'comment', name: 'leaves.comment', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_saved").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '<?php echo e(route('leave.datatable.access.saved')); ?>',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'type_name', name: 'leave_types.name', searchable: true},
                    { data: 'start_date', name: 'leaves.start_date', searchable: true},
                    { data: 'end_date', name: 'leaves.end_date', searchable: true },
                    { data: 'comment', name: 'leaves.comment', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/reports/hr/leave/datatable/index.blade.php ENDPATH**/ ?>