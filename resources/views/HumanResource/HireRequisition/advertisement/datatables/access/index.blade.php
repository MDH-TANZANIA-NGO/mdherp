<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#processing" class="active" data-toggle="tab">Requested <span class="badge badge-primary">{{ $advertisement->getAccessProcessingDatatable()->count() }}</span></a></li>
                    <li><a href="#returned" data-toggle="tab">Returned for Modification <span class="badge badge-warning">{{ $advertisement->getAccessDeniedDatatable()->count() }}</span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Rejected <span class="badge badge-danger">{{ $advertisement->getAccessRejectedDatatable()->count() }}</span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{ $advertisement->getAccessProvedDatatable()->count() }}</span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-dark">{{ $advertisement->getAccessSavedDatatable()->count() }}</span></a></li>
                </ul>
            </div>
            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('advertisement.create') }}"> <i class="fa fa-plus mr-2"></i>Create Request</a>

                    <a href="{{ route('advertisement.post') }}"> <i class="fa fa-plus mr-2"></i>Post Advertisement </a> 
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
                                        <th class="wd-15p">TITLE</th>
                                        <!-- <th class="wd-15p">DESCRIPTION</th> -->
                                        <th class="wd-25p">CREATED AT</th>
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
                                        <!-- <th class="wd-15p">DESCRIPTION</th> -->
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
                                        <!-- <th class="wd-15p">DESCRIPTION</th> -->
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
                                        <!-- <th class="wd-15p">DESCRIPTION</th> -->
                                        <th class="wd-25p">CREATED AT</th>
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
                                        <!-- <th class="wd-15p">DESCRIPTION</th> -->
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
                ajax: '{{ route('advertisement.datatable.access.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'listings.title', searchable: true},
                    // { data: 'description', name: 'hr_hire_advertisement_requisitions.description', searchable: true},
                    { data: 'created_at', name: 'hr_hire_advertisement_requisitions.created_at', searchable: true },
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
                ajax: '{{ route('advertisement.datatable.access.returned') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'hr_hire_advertisement_requisitions.title', searchable: true},
                    // { data: 'description', name: 'hr_hire_advertisement_requisitions.description', searchable: true},
                    { data: 'created_at', name: 'hr_hire_advertisement_requisitions.created_at', searchable: true },
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
                ajax: '{{ route('advertisement.datatable.access.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'hr_hire_advertisement_requisitions.title', searchable: true},
                    // { data: 'description', name: 'hr_hire_advertisement_requisitions.name', searchable: true},
                    { data: 'created_at', name: 'hr_hire_advertisement_requisitions.created_at', searchable: true },
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
                ajax: '{{ route('advertisement.datatable.access.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'hr_hire_advertisement_requisitions.title', searchable: true},
                    // { data: 'description', name: 'hr_hire_advertisement_requisitions.name', searchable: true},
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
                ajax: '{{ route('advertisement.datatable.access.saved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'hr_hire_advertisement_requisitions.title', searchable: true},
                    // { data: 'description', name: 'hr_hire_advertisement_requisitions.name', searchable: true},
                    { data: 'created_at', name: 'hr_hire_advertisement_requisitions.created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
           
            
        })
    </script>
@endpush
