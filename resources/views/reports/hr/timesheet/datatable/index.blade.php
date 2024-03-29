
<div class="row">
    <div class="col-2 mt-2">
        <label class="form-label">Select Month</label>
        <select name="month" id="select-month" class="form-control custom-select month">
            @foreach($months as $month)
                <option value="{{$month->month_year}}">{{ $month->month_year }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#processing" data-toggle="tab" class="active">Processing <span class="badge badge-primary">{{ $timesheets->getSubmittedTimesheets(date('m', strtotime(today())), date('Y', strtotime(today())))->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{$timesheets->getApprovedTimesheets(date('m', strtotime(today())), date('Y', strtotime(today())))->count()  }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Rejected <span class="badge badge-danger">{{ $timesheets->getRejectedTimesheets(date('m', strtotime(today())), date('Y', strtotime(today())))->count()  }}</span> </a></li>
                    <li><a href="#not_submitted" data-toggle="tab" class="">Not Submitted <span class="badge badge-danger">{{ $users->getAllNotSubmittedTimesheet(date('m', strtotime(today())), date('Y', strtotime(today())))->count()  }}</span> </a></li>
                </ul>
            </div>
            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('timesheet.start') }}"> <i class="fa fa-calendar-check-o"></i> Initiate Timesheet Reminder</a>
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
{{--                                    <th class="wd-15p">#</th>--}}
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

                <div class="tab-pane" id="not_submitted">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="all_not_submitted" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-25p">Employee ID</th>
                                    <th class="wd-25p">Employee Name</th>
                                    <th class="wd-25p">Employee Email</th>
                                    <th class="wd-15p">Employee Phone</th>
                                    <th class="wd-15p">Employee Workstation</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @push('after-scripts')
            <script>
                $(document).ready(function () {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let $access_processing = $("#access_processing");
                    $access_processing.DataTable({
                        destroy: true,
                        retrieve: true,
                        "responsive": true,
                        "autoWidth": false,
                        ajax: {
                            url: "{{ route('timesheet_report.submitted') }}",
                            type: 'GET',
                            data: function (data) {
                                data.month = $('.month').val()
                            }
                        },
                        columns: [
                            { data: 'identity_number', name: 'users.identity_number', searchable: true},
                            { data: 'fullname', name: 'users.fullname', searchable: true},
                            { data: 'hours', name: 'timesheets.hrs', searchable: true},
                            { data: 'created_at', name: 'created_at', searchable: true },
                            { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                            { data: 'action', name: 'action', searchable: false },
                        ]
                    });


                    let $access_rejected = $("#access_rejected");
                    $access_rejected.DataTable({
                        destroy: true,
                        retrieve: true,
                        "responsive": true,
                        "autoWidth": false,
                        ajax: {
                            url: "{{ route('timesheet_report.rejected') }}",
                            type: 'GET',
                            data: function (data) {
                                data.month = $('.month').val()
                            }
                        },
                        columns: [
                            { data: 'identity_number', name: 'users.identity_number', searchable: true},
                            { data: 'fullname', name: 'users.fullname', searchable: true},
                            { data: 'hours', name: 'timesheets.hrs', searchable: true},
                            { data: 'created_at', name: 'created_at', searchable: true },
                            { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                            { data: 'action', name: 'action', searchable: false },
                        ]
                    });

                    let $access_approved = $("#access_approved");
                    $access_approved.DataTable({
                        destroy: true,
                        retrieve: true,
                        "responsive": true,
                        "autoWidth": false,
                        ajax: {
                            url: "{{ route('timesheet_report.approved') }}",
                            type: 'GET',
                            data: function (data) {
                                data.month = $('.month').val()
                            }
                        },
                        columns: [
                            { data: 'identity_number', name: 'users.identity_number', searchable: true},
                            { data: 'fullname', name: 'users.fullname', searchable: true},
                            { data: 'hours', name: 'timesheets.hrs', searchable: true},
                            { data: 'created_at', name: 'created_at', searchable: true },
                            { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                            { data: 'action', name: 'action', searchable: false },
                        ]
                    });

                    let $all_not_submitted = $("#all_not_submitted");
                    $all_not_submitted.DataTable({
                        destroy: true,
                        retrieve: true,
                        "responsive": true,
                        "autoWidth": false,
                        ajax: {
                            url: "{{ route('timesheet_report.not_submitted') }}",
                            type: 'GET',
                            data: function (data) {
                                data.month = $('.month').val()
                            }
                        },
                        columns: [
                            { data: 'identity_number', name: 'users.identity_number', searchable: true},
                            { data: 'fullname', name: 'users.fullname', searchable: true},
                            { data: 'hours', name: 'timesheets.hrs', searchable: true},
                            { data: 'created_at', name: 'created_at', searchable: true },
                            { data: 'wf_done_date', name: 'timesheets.wf_done_date', searchable: true },
                            { data: 'action', name: 'action', searchable: false },
                        ]
                    });

                    $("select[name='month']").change(function (){
                        $access_processing.DataTable().ajax.reload()
                        $access_rejected.DataTable().ajax.reload()
                        $access_approved.DataTable().ajax.reload()
                        $all_not_submitted.DataTable().ajax.reload()
                    })
                })
            </script>
        @endpush

    </div>
</div>

