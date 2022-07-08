@extends('layouts.app')
@section('content')

<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">On Process <span class="badge badge-primary"></span></a></li>
                    <li><a href="#returned_for_modification" data-toggle="tab" class="">Returned for Modification <span class="badge badge-warning"></span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success"></span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default"></span> </a></li>
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
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p"># JOBS</th>
                                    <th class="wd-15p">CREATED BY</th>
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
                                    <th class="wd-15p"># JOBS</th>
                                    <th class="wd-15p">CREATED BY</th>
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
                                    <th class="wd-15p"># JOBS</th>
                                    <th class="wd-15p">CREATED BY</th>
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
                                    <th class="wd-15p"># JOBS</th>
                                    <th class="wd-15p">CREATED BY</th>
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
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('hr.pr.datatable.access.processing') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'number_of_jobs', name: 'number_of_jobs', searchable: false},
                    { data: 'user_name', name: 'users.first_name', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_returned_for_modification").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('hr.pr.datatable.access.return_for_modification') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'number_of_jobs', name: 'number_of_jobs', searchable: false},
                    { data: 'user_name', name: 'users.first_name', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_approved").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('hr.pr.datatable.access.approved') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'number_of_jobs', name: 'number_of_jobs', searchable: false},
                    { data: 'user_name', name: 'users.first_name', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#access_saved").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "{{ route('hr.pr.datatable.access.saved') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'pr_reports.number', searchable: true},
                    { data: 'number_of_jobs', name: 'number_of_jobs', searchable: false},
                    { data: 'user_name', name: 'users.first_name', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush