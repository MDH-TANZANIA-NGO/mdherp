@extends('layouts.app')

@section('content')
    <div class="card-body p-6">
        <div class="panel panel-primary">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1 ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class=""><a href="#tab5" class="active" data-toggle="tab">Active Vehicles{{-- <span class="badge badge-success">20</span>--}}</a></li>
                        <li><a href="#tab6" data-toggle="tab" class="">Inactive Vehicles {{--<span class="badge badge-danger">5</span>--}}</a></li>
                    </ul>
                </div>



            </div>
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab5">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="active_users" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">Vehicle Type</th>
                                        <th class="wd-15p">Vehicle Maker</th>
                                        <th class="wd-20p">Vehicle Model</th>
                                        <th class="wd-20p">Body type</th>
                                        <th class="wd-10p">Fuel Type</th>
                                        <th class="wd-10p">Vehicle Registration</th>
                                        <th class="wd-20p">Driver Assigned</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab6">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="diactive_users" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">First name</th>
                                        <th class="wd-15p">Last name</th>
                                        <th class="wd-20p">Email</th>
                                        <th class="wd-20p">Position</th>
                                        <th class="wd-15p">Region</th>
                                        <th class="wd-10p">Projects</th>
                                        <th class="wd-25p"></th>
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
