<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#processing" data-toggle="tab" class="active">Processing <span class="badge badge-primary">{{ $fleet_requests->getAccessProcessingDatatable()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{$fleet_requests->getAccessApprovedDatatable()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned for Modification <span class="badge badge-danger">{{ $fleet_requests->getAccessRejectedDatatable()->count() }}</span> </a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $fleet_requests->getAccessSavedDatatable()->count() }}</span> </a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('fleet.create') }}"> <i class="fa fa-plus mr-2"></i>Apply Fleet Request</a>
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
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Program</th>
                                        <th class="wd-25p">Description</th>
                                        <th class="wd-25p">Location</th>
                                        <th class="wd-25p">Starting time</th>
                                        <th class="wd-25p">Ending time</th>
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
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Program</th>
                                        <th class="wd-25p">Description</th>
                                        <th class="wd-25p">Location</th>
                                        <th class="wd-25p">Starting time</th>
                                        <th class="wd-25p">Ending time</th>
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
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Program</th>
                                        <th class="wd-25p">Description</th>
                                        <th class="wd-25p">Location</th>
                                        <th class="wd-25p">Starting time</th>
                                        <th class="wd-25p">Ending time</th>
                                        <th class="wd-25p">Action</th>
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
                                        <th class="wd-15p">Date</th>
                                        <th class="wd-15p">Program</th>
                                        <th class="wd-25p">Description</th>
                                        <th class="wd-25p">Location</th>
                                        <th class="wd-25p">Starting time</th>
                                        <th class="wd-25p">Ending time</th>
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
    $(document).ready(function() {

        $("#access_processing").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{route('fleet.datatable.access.processing')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'date',
                    name: 'fleet_requests.date',
                    searchable: true
                },
                {
                    data: 'program',
                    name: 'fleet_requests.program',
                    searchable: true
                },
                {
                    data: 'activity_description',
                    name: 'fleet_requests.activity_description',
                    searchable: true
                },
                {
                    data: 'location',
                    name: 'fleet_requests.location',
                    searchable: false
                },
                {
                    data: 'starting_time',
                    name: 'starting_time',
                    searchable: true
                },
                {
                    data: 'ending_time',
                    name: 'ending_time',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });

        $("#access_rejected").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('fleet.datatable.access.rejected') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'date',
                    name: 'fleet_requests.date',
                    searchable: true
                },
                {
                    data: 'program',
                    name: 'fleet_requests.program',
                    searchable: true
                },
                {
                    data: 'activity_description',
                    name: 'fleet_requests.activity_description',
                    searchable: true
                },
                {
                    data: 'location',
                    name: 'fleet_requests.location',
                    searchable: false
                },
                {
                    data: 'starting_time',
                    name: 'starting_time',
                    searchable: true
                },
                {
                    data: 'ending_time',
                    name: 'ending_time',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });

        $("#access_approved").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('fleet.datatable.access.approved') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'date',
                    name: 'fleet_requests.date',
                    searchable: true
                },
                {
                    data: 'program',
                    name: 'fleet_requests.program',
                    searchable: true
                },
                {
                    data: 'activity_description',
                    name: 'fleet_requests.activity_description',
                    searchable: true
                },
                {
                    data: 'location',
                    name: 'fleet_requests.location',
                    searchable: false
                },
                {
                    data: 'starting_time',
                    name: 'starting_time',
                    searchable: true
                },
                {
                    data: 'ending_time',
                    name: 'ending_time',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });
        $("#access_saved").DataTable({

            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('fleet.datatable.access.saved') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'date',
                    name: 'fleet_requests.date',
                    searchable: true
                },
                {
                    data: 'program',
                    name: 'fleet_requests.program',
                    searchable: true
                },
                {
                    data: 'activity_description',
                    name: 'fleet_requests.activity_description',
                    searchable: true
                },
                {
                    data: 'location',
                    name: 'fleet_requests.location',
                    searchable: false
                },
                {
                    data: 'starting_time',
                    name: 'starting_time',
                    searchable: true
                },
                {
                    data: 'ending_time',
                    name: 'ending_time',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });

    })
</script>
@endpush