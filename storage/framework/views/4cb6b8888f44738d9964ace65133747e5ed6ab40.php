<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">On Process <span class="badge badge-primary"><?php echo e($processing_count); ?></span></a></li>
                    <li><a href="#returned_for_modification" data-toggle="tab" class="">Returned for Modification <span class="badge badge-warning"><?php echo e($return_for_modification_count); ?></span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success"><?php echo e($approved_count); ?></span></a></li>
                    <li><a href="#wait_for_interview_questions" data-toggle="tab" class="">Waiting For Interview Questions <span class="badge badge-info"><?php echo e($wait_interview_question_count); ?></span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default"><?php echo e($saved_count); ?></span> </a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="<?php echo e(route('interview.create')); ?>"> <i class="fa fa-plus mr-2"></i>Create</a>
                </div>
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
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">FISCAL YEAR</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">APPLIED DATE</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="returned_for_modification">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_returned_for_modification" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">FISCAL YEAR</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">APPLIED DATE</th>
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
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">FISCAL YEAR</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">APPLIED DATE</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="wait_for_interview_questions">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_wait_for_interview_questions" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">NUMBER</th>
                                        <th class="wd-15p">JOB TITLE</th>
                                        <th class="wd-15p">TYPE</th>
                                        <th class="wd-15p">INTERVIEW DATE</th>
                                        <th class="wd-25p">CREATED AT</th>
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
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-15p">FISCAL YEAR</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">APPLIED DATE</th>
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
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "<?php echo e(route('hr.pr.datatable.access.processing')); ?>",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'pr_type_title', name: 'pr_types.title', searchable: true},
                    { data: 'fiscal_year_title', name: 'fiscal_years.title', searchable: true},
                    { data: 'from_at', name: 'pr_reports.from_at', searchable: true},
                    { data: 'to_at', name: 'pr_reports.to_at', searchable: true },
                    { data: 'submited_at', name: 'pr_reports.submited_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_returned_for_modification").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "<?php echo e(route('hr.pr.datatable.access.return_for_modification')); ?>",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'pr_type_title', name: 'pr_types.title', searchable: true},
                    { data: 'fiscal_year_title', name: 'fiscal_years.title', searchable: true},
                    { data: 'from_at', name: 'pr_reports.from_at', searchable: true},
                    { data: 'to_at', name: 'pr_reports.to_at', searchable: true },
                    { data: 'submited_at', name: 'pr_reports.submited_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_approved").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "<?php echo e(route('hr.pr.datatable.access.approved')); ?>",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'pr_type_title', name: 'pr_types.title', searchable: true},
                    { data: 'fiscal_year_title', name: 'fiscal_years.title', searchable: true},
                    { data: 'from_at', name: 'pr_reports.from_at', searchable: true},
                    { data: 'to_at', name: 'pr_reports.to_at', searchable: true },
                    { data: 'submited_at', name: 'pr_reports.submited_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_wait_for_interview_questions").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "<?php echo e(route('interview.datatable.access.wait_for_interview_question')); ?>",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'job_title', name: '', searchable: true},
                    { data: 'interview_type', name: 'fiscal_years.title', searchable: true},
                    { data: 'interview_date', name: 'pr_reports.from_at', searchable: true},
                    { data: 'created_at', name: 'pr_reports.to_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_saved").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "<?php echo e(route('hr.pr.datatable.access.saved')); ?>",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'pr_type_title', name: 'pr_types.title', searchable: true},
                    { data: 'fiscal_year_title', name: 'fiscal_years.title', searchable: true},
                    { data: 'from_at', name: 'pr_reports.from_at', searchable: true},
                    { data: 'to_at', name: 'pr_reports.to_at', searchable: true },
                    { data: 'submited_at', name: 'pr_reports.submited_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/datatables/access.blade.php ENDPATH**/ ?>