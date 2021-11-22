<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#tab6" class="active" data-toggle="tab">Requested <span class="badge badge-primary">20</span></a></li>
                    <li><a href="#tab6" data-toggle="tab" class="">Rejected {{--<span class="badge badge-danger">5</span>--}}</a></li>
                    <li><a href="#tab6" data-toggle="tab" class="">Approved {{--<span class="badge badge-danger">5</span>--}}</a></li>
                    <li><a href="#tab6" data-toggle="tab" class="">Saved {{--<span class="badge badge-danger">5</span>--}}</a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('requisition.create') }}"> <i class="fa fa-plus mr-2"></i>Create Request</a>
                </div>
            </div>

        </div>
        <div class="panel-body tabs-menu-body">
            <div class="tab-content">
{{--                <div class="tab-pane active" id="tab5">--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="active_users" class="table table-striped table-bordered" style="width:100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="wd-15p">#</th>--}}
{{--                                    <th class="wd-15p">First name</th>--}}
{{--                                    <th class="wd-15p">Last name</th>--}}
{{--                                    <th class="wd-20p">Email</th>--}}
{{--                                    <th class="wd-20p">Position</th>--}}
{{--                                    <th class="wd-15p">Region</th>--}}
{{--                                    <th class="wd-10p">Projects</th>--}}
{{--                                    <th class="wd-25p">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
                <div class="tab-pane active" id="tab6">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="diactive_users" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NUMBER</th>
                                    <th class="wd-15p">TYPE</th>
                                    <th class="wd-20p">ITEMS LIST</th>
                                    <th class="wd-25p">AMOUNT</th>
                                    <th class="wd-25p">APPLIED DATE</th>
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

            $("#active_users").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('user.datatable.active') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'first_name', name: 'users.first_name', searchable: true},
                    { data: 'last_name', name: 'users.last_name', searchable: true},
                    { data: 'email', name: 'users.email', searchable: true},
                    { data: 'designation', name: 'unit.name', searchable: true},
                    { data: 'region', name: 'regions.name', searchable: true},
                    { data: 'project_list', name: 'projects.title', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
