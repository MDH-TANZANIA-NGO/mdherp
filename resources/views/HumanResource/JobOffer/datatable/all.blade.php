<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#processing" class="active" data-toggle="tab">On Process <span class="badge badge-primary">{{$job_offers->getAccessProcessing()->count()}}</span></a></li>
                    <li><a href="#returned" data-toggle="tab">Returned for Modification <span class="badge badge-warning">{{$job_offers->getAccessRejected()->count()}}</span></a></li>
{{--                    <li><a href="#rejected" data-toggle="tab" class="">Rejected <span class="badge badge-danger"></span></a></li>--}}
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success">{{$job_offers->getAccessApproved()->count()}}</span></a></li>
{{--                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-dark"></span></a></li>--}}
                </ul>
            </div>
            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('job_offer.initiate') }}"> <i class="fa fa-plus mr-2"></i>Create Offer</a>
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
<<<<<<< HEAD
                                    <th class="wd-15p">TITLE</th>
                                    <th class="wd-15p">REGION</th>
                                    <th class="wd-25p"># OF EMPLOYEES</th>
                                    <th class="wd-25p">CREATED AT</th>
=======
                                    <th class="wd-15p">APPLICANT NAME</th>
                                    <th class="wd-15p">JOB TITLE</th>
                                    <th class="wd-25p">OFFER</th>
                                    <th class="wd-25p">OFFER NUMBER</th>
>>>>>>> 254d9775035842df159ba3bee91a91016519a14f
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
                                    <th class="wd-15p">APPLICANT NAME</th>
                                    <th class="wd-15p">JOB TITLE</th>
                                    <th class="wd-25p">OFFER</th>
<<<<<<< HEAD
                                    <th class="wd-25p">CREATED AT</th>
=======
                                    <th class="wd-25p">OFFER NUMBER</th>
>>>>>>> 254d9775035842df159ba3bee91a91016519a14f
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
                                    <th class="wd-15p">APPLICANT NAME</th>
                                    <th class="wd-15p">JOB TITLE</th>
                                    <th class="wd-25p">OFFER</th>
<<<<<<< HEAD
                                    <th class="wd-25p">CREATED AT</th>
=======
                                    <th class="wd-25p">OFFER NUMBER</th>
>>>>>>> 254d9775035842df159ba3bee91a91016519a14f
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
                ajax: '{{ route('job_offer.datatable.access.processing') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
<<<<<<< HEAD
                    { data: 'number', name: 'job_offers.name', searchable: true},
                    { data: 'designation_id', name: 'job_offers.designation_id', searchable: true},
                    { data: 'salary', name: 'job_offers.salary', searchable: true },
                    { data: 'created_at', name: 'created_at', searchable: true },
=======
                    { data: 'full_name', name: 'job_offers.name', searchable: true},
                    { data: 'full_title', name: 'job_offers.designation_id', searchable: true},
                    { data: 'salary', name: 'job_offers.salary', searchable: true },
                    { data: 'number', name: 'number', searchable: true },
>>>>>>> 254d9775035842df159ba3bee91a91016519a14f
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
                ajax: '{{ route('job_offer.datatable.access.rejected') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'job_offers.name', searchable: true},
                    { data: 'full_title', name: 'job_offers.full_title', searchable: true},
                    { data: 'salary', name: 'job_offers.salary', searchable: true },
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
                ajax: '{{ route('job_offer.datatable.access.approved') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'number', name: 'job_offers.name', searchable: true},
                    { data: 'full_title', name: 'job_offers.full_title', searchable: true},
                    { data: 'salary', name: 'job_offers.salary', searchable: true },
                    { data: 'created_at', name: 'created_at', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });



        })
    </script>
@endpush
