<div class="card-body p-0 mb-4">
    <div class="panel panel-primary">
    
        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="processing">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-15p">DATE REQUIRED</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="returned">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_returned" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-15p">DATE REQUIRED</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
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
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-15p">DATE REQUIRED</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
                                    <th class="wd-25p">BUDGET</th>
                                    <th class="wd-25p">CREATED AT</th>
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
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-15p">DATE REQUIRED</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
                                    <th class="wd-25p">BUDGET</th>
                                    <th class="wd-25p">CREATED AT</th>
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
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-15p">DATE REQUIRED</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
                                    <th class="wd-25p">BUDGET</th>
                                    <th class="wd-25p">CREATED AT</th>
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
                 //processing: true,
                 //serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
               // ajax: '{{ route('hirerequisition.datatable.access.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'listings.title', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'date_required', name: 'listings.date_required', searchable: true},
                    { data: 'number', name: 'listings.number', searchable: true },
                    { data: 'budget', name: 'listings.budget', searchable: true },
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });

            $("#access_returned").DataTable({
                //processing: true,
                //serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
               // ajax: '{{ route('hirerequisition.datatable.access.returned') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'listings.title', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'date_required', name: 'listings.date_required', searchable: true},
                    { data: 'number', name: 'listings.number', searchable: true },
                    { data: 'budget', name: 'listings.budget', searchable: true },
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
                //ajax: '{{ route('hirerequisition.datatable.access.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'listings.title', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'date_required', name: 'listings.date_required', searchable: true},
                    { data: 'number', name: 'listings.number', searchable: true },
                    { data: 'budget', name: 'listings.budget', searchable: true },
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
                //ajax: '{{ route('hirerequisition.datatable.access.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'listings.title', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'date_required', name: 'listings.date_required', searchable: true},
                    { data: 'number', name: 'listings.number', searchable: true },
                    { data: 'budget', name: 'listings.budget', searchable: true },
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
