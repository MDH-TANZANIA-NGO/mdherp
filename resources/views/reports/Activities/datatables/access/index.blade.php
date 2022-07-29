<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">Onprocess <span class="badge badge-warning">{{ $activity_report->getAccessProcessing()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned <span class="badge badge-danger">{{ $activity_report->getAccessRejected()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{ $activity_report->getAccessApproved()->count() }}</span></a></li>
                    {{--                    <li><a href="#paid" data-toggle="tab" class="">Paid <span class="badge badge-primary">{{ $safariAdvance->getAccessPaidDatatable()->count() }}</span> </a></li>--}}
{{--                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $safariAdvance->getAccessSavedDatatable()->count() }}</span> </a></li>--}}
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('activity_report.initiate') }}"> <i class="fa fa-plus mr-2"></i>Create report</a>
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
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">REQUISITION NUMBER</th>
                                    <th class="wd-25p">REGION</th>
                                    <th class="wd-25p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="saved">

                  {{--  <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_saved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">REQUISITION NUMBER</th>
                                    <th class="wd-25p">REGION</th>
                                    <th class="wd-25p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>--}}

                </div>

                <div class="tab-pane" id="approved">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_approved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">REQUISITION NUMBER</th>
                                    <th class="wd-25p">REGION</th>
                                    <th class="wd-25p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">CREATED ON</th>
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
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">REQUISITION NUMBER</th>
                                    <th class="wd-25p">REGION</th>
                                    <th class="wd-25p">START DATE</th>
                                    <th class="wd-25p">END DATE</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                {{-- <div class="tab-pane" id="paid">

                     <div class="card-body">
                         <div class="table-responsive">
                             <table id="access_paid" class="table table-striped table-bordered" style="width:100%">
                                 <thead>
                                 <tr>
                                     <th class="wd-15p">#</th>
                                     <th class="wd-15p">NUMBER</th>
                                     <th class="wd-25p">AMOUNT REQUESTED</th>

                                     <th class="wd-25p">AMOUNT PAID</th>
                                     <th class="wd-25p">CREATED ON</th>
                                     <th class="wd-25p">ACTION</th>
                                 </tr>
                                 </thead>
                             </table>
                         </div>
                     </div>

                 </div>--}}

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
                ajax: '{{ route('access_activity_report.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'activity_reports.number', searchable: true},
                    { data: 'requisition_number', name: 'requisitions.number', searchable: true},
                    { data: 'region_name', name: 'regions.name', searchable: true},
                    { data: 'start_date', name: 'activity_reports.start_date', searchable: true},
                    { data: 'end_date', name: 'activity_reports.end_date', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
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
                ajax: '{{ route('access_activity_report.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'activity_reports.number', searchable: true},
                    { data: 'requisition_number', name: 'requisitions.number', searchable: true},
                    { data: 'region_name', name: 'regions.name', searchable: true},
                    { data: 'start_date', name: 'activity_reports.start_date', searchable: true},
                    { data: 'end_date', name: 'activity_reports.end_date', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
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
                ajax: '{{ route('access_activity_report.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'activity_reports.number', searchable: true},
                    { data: 'requisition_number', name: 'requisitions.number', searchable: true},
                    { data: 'region_name', name: 'regions.name', searchable: true},
                    { data: 'start_date', name: 'activity_reports.start_date', searchable: true},
                    { data: 'end_date', name: 'activity_reports.end_date', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            {{--$("#access_saved").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('safari.datatable.access.saved') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'safari_advances.number', searchable: true},--}}
            {{--        { data: 'amount', name: 'safari_advances.amount_requested', searchable: true},--}}
            {{--        // { data: 'project_title', name: 'projects.title', searchable: true},--}}
            {{--        // { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        // { data: 'amount_paid', name: 'safari_advances.amount_paid', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}
            /*    $("#access_paid").DataTable({
                    // processing: true,
                    // serverSide: true,
                    destroy: true,
                    retrieve: true,
                    "responsive": true,
                    "autoWidth": false,
                    ajax: '{{ route('safari.datatable.access.paid') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'requisitions.number', searchable: true},
                    { data: 'amount_requested', name: 'safari_advances.amount_requested', searchable: true},
                    // { data: 'project_title', name: 'projects.title', searchable: true},
                    // { data: 'activity_title', name: 'activities.title', searchable: true},
                    { data: 'amount_paid', name: 'safari_advances.amount_paid', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });*/
        })
    </script>
@endpush
