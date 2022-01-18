<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#requisition" class="active" data-toggle="tab">Requisitions <span class="badge badge-warning">{{ $requisition->count() }}</span></a></li>
                    <li><a href="#safariAdvance" data-toggle="tab" class="">Safari Advances <span class="badge badge-danger">{{ $safariAdvance->count() }}</span></a></li>
                    <li><a href="#programActivity" data-toggle="tab" class="">Program Activities <span class="badge badge-success">{{ $program_activity->count() }}</span></a></li>
                    <li><a href="#retirement" data-toggle="tab" class="">Retirements <span class="badge badge-primary">{{ $retirement->count() }}</span> </a></li>
                       </ul>
            </div>

{{--            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">--}}
{{--                <div class="btn-group mb-0">--}}
{{--                    <a href="{{ route('safari.initiate') }}"> <i class="fa fa-plus mr-2"></i>Request Advance</a>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="requisition">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="all_requisition" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-25p">AMOUNT REQUESTED</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>



                <div class="tab-pane" id="safariAdvance">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="all_safariAdvance" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-25p">AMOUNT REQUESTED</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="programActivity">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="all_programActivity" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-25p">AMOUNT REQUESTED</th>
                                    <th class="wd-25p">CREATED ON</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="retirement">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="all_retirement" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-25p">AMOUNT REQUESTED</th>
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

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_requisition").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('finance.datatable.access.requisition') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'requisitions.number', searchable: true},
                    { data: 'amount', name: 'requisitions.amount', searchable: true},
                    // { data: 'project_title', name: 'projects.title', searchable: true},
                    // { data: 'activity_title', name: 'activities.title', searchable: true},
                    // { data: 'amount', name: 'requisitions.amount', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#all_safariAdvance").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('finance.datatable.access.safari_advance') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'safari_advances.number', searchable: true},
                    { data: 'amount_requested', name: 'safari_advances.amount_requested', searchable: true},
                    // { data: 'project_title', name: 'projects.title', searchable: true},
                    // { data: 'activity_title', name: 'activities.title', searchable: true},
                    // { data: 'amount', name: 'requisitions.amount', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#all_programActivity").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('finance.datatable.access.program_activity') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'program_activities.number', searchable: true},
                    { data: 'amount_requested', name: 'program_activities.amount_requested', searchable: true},
                    // { data: 'project_title', name: 'projects.title', searchable: true},
                    // { data: 'activity_title', name: 'activities.title', searchable: true},
                    // { data: 'amount_paid', name: 'requisitions.amount', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
            $("#all_retirement").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('finance.datatable.access.retirement') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'retirements.number', searchable: true},
                    { data: 'amount_requested', name: 'retirements.amount_requested', searchable: true},
                    // { data: 'project_title', name: 'projects.title', searchable: true},
                    // { data: 'activity_title', name: 'activities.title', searchable: true},
                    // { data: 'amount_paid', name: 'safari_advances.amount_paid', searchable: true},
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

        })
    </script>
@endpush
