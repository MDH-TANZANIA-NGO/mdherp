<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">On Process <span class="badge badge-warning">{{ $induction_access->getProcessing()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">On Going <span class="badge badge-danger">{{ $leave_access->getAccessRejectedDatatable()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Completed <span class="badge badge-success">{{ $leave_access->getAccessProvedDatatable()->count() }}</span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $leave_access->getAccessSavedDatatable()->count() }}</span> </a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('induction_schedule.initiate') }}" class="btn btn-outline-info"> <i class="fa fa-plus mr-2"></i>Create Schedule</a>
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
                                    <th class="wd-15p">DESIGNATION</th>
                                    <th class="wd-15p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
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

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#access_processing").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('induction_schedule.datatable.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'designation_id', name: 'induction_schedules.designation_id', searchable: true},
                    { data: 'participants', name : 'induction_schedule_participants', searchable: true },
                    { data: 'start_date', name: 'induction_schedules.start_date', searchable: true},
                    { data: 'end_date', name: 'induction_schedules.end_date', searchable: true },
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
                ajax: '{{ route('leave.datatable.access.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
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
                ajax: '{{ route('leave.datatable.access.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
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
                ajax: '{{ route('leave.datatable.access.saved') }}',
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
@endpush
