@extends('layouts.app')
@section('content')

<div class="card-body p-6">
    <div class="panel panel-primary">

        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">Onprocess <span class="badge badge-warning">{{ $program_activity_report_repo->getOnprogressActivityReports()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned <span class="badge badge-danger">{{ $program_activity_report_repo->getReturnedActivityReports()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{ $program_activity_report_repo->getApprovedActivityReports()->count() }}</span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $program_activity_report_repo->getSavedActivityReports()->count() }}</span> </a></li>
                </ul>
            </div>


            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">

                <div class="btn-group mb-0">


                    <a href="{{ route('programactivityreport.initiate') }}"> <i class="fa fa-plus mr-2"></i>Initiate Report</a>
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
                                    <th class="wd-25p">ACTIVITY NUMBER</th>
                                    <th class="wd-25p">REPORT TYPE</th>
                                    <th class="wd-25p">CREATED ON</th>
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
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">ACTIVITY NUMBER</th>
                                    <th class="wd-25p">REPORT TYPE</th>
                                    <th class="wd-25p">CREATED ON</th>
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
                                    <th class="wd-15p">REPORT NUMBER</th>
                                    <th class="wd-25p">ACTIVITY NUMBER</th>
                                    <th class="wd-25p">REPORT TYPE</th>
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
                                    <th class="wd-25p">ACTIVITY NUMBER</th>
                                    <th class="wd-25p">REPORT TYPE</th>
                                    <th class="wd-25p">CREATED ON</th>
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
@endsection
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
                ajax: '{{ route('programactivityreport.datatable.access.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'program_activities_reports.number', searchable: true},
                    { data: 'activity_number', name: 'program_activities.number', searchable: true},
                    { data: 'status', name: 'program_activities_reports.status', searchable: true},
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
                ajax: '{{ route('programactivityreport.datatable.access.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'program_activities_reports.number', searchable: true},
                    { data: 'activity_number', name: 'program_activities.number', searchable: true},
                    { data: 'status', name: 'program_activities_reports.status', searchable: true},
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
                ajax: '{{ route('programactivityreport.datatable.access.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'program_activities_reports.number', searchable: true},
                    { data: 'activity_number', name: 'program_activities.number', searchable: true},
                    { data: 'status', name: 'program_activities_reports.status', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
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
                ajax: '{{ route('programactivityreport.datatable.access.saved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'program_activities_reports.number', searchable: true},
                    { data: 'activity_number', name: 'program_activities.number', searchable: true},
                    { data: 'status', name: 'program_activities_reports.status', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

        })
    </script>
@endpush
