<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">All requisitions <span class="badge badge-primary">{{$all_requisitions->count()}}</span></a></li>
{{--                    <li><a href="#rejected" data-toggle="tab" class="">Returned for Modification <span class="badge badge-warning">{{ $requisition_access->getAccessRejectedDatatable()->count() }}</span></a></li>--}}
{{--                    <li><a href="#denied" data-toggle="tab" class="">Rejected <span class="badge badge-danger">{{ $requisition_access->getAccessDeniedDatatable()->count() }}</span></a></li>--}}
{{--                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{ $requisition_access->getAccessApprovedDatatable()->count() }}</span></a></li>--}}
{{--                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $requisition_access->getAccessSavedDatatable()->count() }}</span> </a></li>--}}
{{--                    <li><a href="#paid" data-toggle="tab" class="">Paid <span class="badge badge-primary">{{ $requisition_access->getAccessPaidDatatable()->count() }}</span> </a></li>--}}
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
{{--                    <a href="{{ route('requisition.create') }}"> <i class="fa fa-plus mr-2"></i>Create Request</a>--}}
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
                                    <th class="wd-25p">FULL NAME</th>
                                    <th class="wd-15p">ACTIVITY</th>
                                    <th class="wd-25p">AMOUNT</th>
                                    <th class="wd-25p">APPLIED DATE</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>


{{--                <div class="tab-pane" id="saved">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="access_saved" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">NUMBER</th>--}}
{{--                                    <th class="wd-15p">TYPE</th>--}}
{{--                                    --}}{{--                                    <th class="wd-15p">PROJECT</th>--}}
{{--                                    <th class="wd-15p">ACTIVITY</th>--}}
{{--                                    <th class="wd-25p">AMOUNT</th>--}}
{{--                                    <th class="wd-25p">APPLIED DATE</th>--}}
{{--                                    <th class="wd-25p">ACTION</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="tab-pane" id="paid">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="access_paid" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">NUMBER</th>--}}
{{--                                    <th class="wd-15p">TYPE</th>--}}
{{--                                    --}}{{--                                    <th class="wd-15p">PROJECT</th>--}}
{{--                                    <th class="wd-15p">ACTIVITY</th>--}}
{{--                                    <th class="wd-25p">REQUESTED</th>--}}
{{--                                    <th class="wd-25p">PAID</th>--}}
{{--                                    <th class="wd-25p">STATUS</th>--}}
{{--                                    <th class="wd-25p">APPLIED DATE</th>--}}
{{--                                    <th class="wd-25p">ACTION</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="tab-pane" id="approved">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="access_approved" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">NUMBER</th>--}}
{{--                                    <th class="wd-15p">TYPE</th>--}}
{{--                                    --}}{{--                                    <th class="wd-15p">PROJECT</th>--}}
{{--                                    <th class="wd-15p">ACTIVITY</th>--}}
{{--                                    <th class="wd-25p">AMOUNT</th>--}}
{{--                                    <th class="wd-25p">APPLIED DATE</th>--}}
{{--                                    <th class="wd-25p">ACTION</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="tab-pane" id="rejected">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="access_rejected" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">NUMBER</th>--}}
{{--                                    <th class="wd-15p">TYPE</th>--}}
{{--                                    --}}{{--                                    <th class="wd-15p">PROJECT</th>--}}
{{--                                    <th class="wd-15p">ACTIVITY</th>--}}
{{--                                    <th class="wd-25p">AMOUNT</th>--}}
{{--                                    <th class="wd-25p">APPLIED DATE</th>--}}
{{--                                    <th class="wd-25p">ACTION</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="tab-pane" id="denied">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="access_denied" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">NUMBER</th>--}}
{{--                                    <th class="wd-15p">TYPE</th>--}}
{{--                                    --}}{{--                                    <th class="wd-15p">PROJECT</th>--}}
{{--                                    <th class="wd-15p">ACTIVITY</th>--}}
{{--                                    <th class="wd-25p">AMOUNT</th>--}}
{{--                                    <th class="wd-25p">APPLIED DATE</th>--}}
{{--                                    <th class="wd-25p">ACTION</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

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
                ajax: '{{ route('requisition.datatable.all.all_submitted') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'requisitions.number', searchable: true},
                    { data: 'type_title', name: 'requisitions.title', searchable: true},
                    { data: 'user', name: 'users.first_name', searchable: true},
                    { data: 'activity_title', name: 'activities.title', searchable: true},
                    { data: 'amount', name: 'requisitions.amount', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            {{--$("#access_paid").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('requisition.datatable.access.paid') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'requisitions.number', searchable: true},--}}
            {{--        { data: 'type_title', name: 'requisitions.title', searchable: true},--}}
            {{--        // { data: 'project_title', name: 'projects.title', searchable: true},--}}
            {{--        { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        { data: 'amount', name: 'requisitions.amount', searchable: true},--}}
            {{--        { data: 'payed_amount', name: 'payments.payed_amount', searchable: true},--}}
            {{--        { data: 'is_closed', name: 'requisitions.is_closed', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}
            {{--$("#access_rejected").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('requisition.datatable.access.rejected') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'requisitions.number', searchable: true},--}}
            {{--        { data: 'type_title', name: 'requisitions.title', searchable: true},--}}
            {{--        // { data: 'project_title', name: 'projects.title', searchable: true},--}}
            {{--        { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        { data: 'amount', name: 'requisitions.amount', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}

            {{--$("#access_denied").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('requisition.datatable.access.denied') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'requisitions.number', searchable: true},--}}
            {{--        { data: 'type_title', name: 'requisitions.title', searchable: true},--}}
            {{--        // { data: 'project_title', name: 'projects.title', searchable: true},--}}
            {{--        { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        { data: 'amount', name: 'requisitions.amount', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}
            {{--$("#access_approved").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('requisition.datatable.access.approved') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'requisitions.number', searchable: true},--}}
            {{--        { data: 'type_title', name: 'requisitions.title', searchable: true},--}}
            {{--        // { data: 'project_title', name: 'projects.title', searchable: true},--}}
            {{--        { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        { data: 'amount', name: 'requisitions.amount', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}
            {{--$("#access_saved").DataTable({--}}
            {{--    // processing: true,--}}
            {{--    // serverSide: true,--}}
            {{--    destroy: true,--}}
            {{--    retrieve: true,--}}
            {{--    "responsive": true,--}}
            {{--    "autoWidth": false,--}}
            {{--    ajax: '{{ route('requisition.datatable.access.saved') }}',--}}
            {{--    columns: [--}}
            {{--        { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
            {{--        { data: 'number', name: 'requisitions.number', searchable: true},--}}
            {{--        { data: 'type_title', name: 'requisitions.title', searchable: true},--}}
            {{--        { data: 'user', name: 'users.first_name', searchable: true},--}}
            {{--        { data: 'activity_title', name: 'activities.title', searchable: true},--}}
            {{--        { data: 'amount', name: 'requisitions.amount', searchable: true},--}}
            {{--        { data: 'created_at', name: 'created_at', searchable: true },--}}
            {{--        { data: 'action', name: 'action', searchable: false },--}}
            {{--    ]--}}
            {{--});--}}
        })
    </script>
@endpush
