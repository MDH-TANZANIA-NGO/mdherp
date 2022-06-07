<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#processing" data-toggle="tab" class="active">Processing <span class="badge badge-primary">{{ $timesheets->getAccessProcessingDatatable()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{$timesheets->getAccessApprovedDatatable()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned for Modification <span class="badge badge-danger">{{ $timesheets->getAccessRejectedDatatable()->count() }}</span> </a></li>
                </ul>
            </div>

           @if($visibility)
                <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                    <div class="btn-group mb-0">
                        <a href="{{ route('timesheet.initiate') }}"> <i class="fa fa-plus mr-2"></i>Create Timesheet</a>
                    </div>
                </div>
            @endif

        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="all">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-25p">Employee ID</th>
                                    <th class="wd-25p">Employee Name</th>
                                    <th class="wd-25p">Hours</th>
                                    <th class="wd-15p">Submitted</th>
                                    <th class="wd-25p">Approval Date</th>
                                    <th class="wd-25p">Action</th>
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
                                    <th class="wd-25p">Employee ID</th>
                                    <th class="wd-25p">Employee Name</th>
                                    <th class="wd-25p">Hours</th>
                                    <th class="wd-15p">Submitted</th>
                                    <th class="wd-25p">Approval Date</th>
                                    <th class="wd-25p">Action</th>
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
                                    <th class="wd-25p">Employee ID</th>
                                    <th class="wd-25p">Employee Name</th>
                                    <th class="wd-25p">Hours</th>
                                    <th class="wd-15p">Submitted</th>
                                    <th class="wd-25p">Approval Date</th>
                                    <th class="wd-25p">Action</th>
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
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('timesheet.datatable.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'identity_number', name: 'users.identity_number', searchable: true},
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'hours', name: 'timesheets.hrs', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            

            $("#access_rejected").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('timesheet.datatable.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'identity_number', name: 'users.identity_number', searchable: true},
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'hours', name: 'timesheets.hrs', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

            $("#access_approved").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('timesheet.datatable.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'identity_number', name: 'users.identity_number', searchable: true},
                    { data: 'fullname', name: 'users.fullname', searchable: true},
                    { data: 'hours', name: 'timesheets.hrs', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

        })
    </script>
@endpush

