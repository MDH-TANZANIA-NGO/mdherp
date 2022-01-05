@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Finance</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="panel panel-primary">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1 ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab1" class="active" data-toggle="tab">Business Requisitions</a></li>
                                <li class=""><a href="#tab2" data-toggle="tab" class="">Safari Advance</a></li>
                                <li class=""><a href="#tab3" data-toggle="tab" class="">Program Activity</a></li>
                            </ul>
                        </div>



                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="active_fleet" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th class="wd-15p">#</th>
                                                <th class="wd-15p">Type</th>
                                                <th class="wd-15p">Maker</th>
                                                <th class="wd-20p">Model</th>
                                                <th class="wd-20p">Body</th>
                                                <th class="wd-10p">Fuel</th>
                                                <th class="wd-10p">Registration #</th>
                                                <th class="wd-20p">Driver</th>
                                                <th class="wd-10p">Action</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2">

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
                            <div class="tab-pane" id="tab3">

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

        </div>
    </div>

@endsection

@push('after-scripts')



{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}

{{--            // var table = $('.yajra-datatable').DataTable({--}}
{{--            $("#active_fleet").DataTable({--}}
{{--                processing: true,--}}
{{--                //serverSide: true,--}}
{{--                destroy:true,--}}
{{--                retrieve: true,--}}
{{--                "responsive": true,--}}
{{--                "autoWidth": false,--}}
{{--                ajax: '{{ route('fleet.datatable.all_fleet') }}',--}}
{{--                columns: [--}}
{{--                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
{{--                    {data: 'vehicle_type', name: 'fleets.vehicle_type', searchable: true},--}}
{{--                    {data: 'maker', name: 'fleets.maker', searchable: true},--}}
{{--                    {data: 'model', name: 'fleets.model', searchable: true},--}}
{{--                    {data: 'body_type', name: 'fleets.body_type', searchable: true},--}}
{{--                    {data: 'fuel_type', name: 'fleets.fuel_type', searchable: true},--}}
{{--                    {data: 'vehicle_reg_no', name: 'fleets.vehicle_reg_no', searchable: true},--}}
{{--                    {data: 'driver', name: 'fleets.driver', searchable: true},--}}
{{--                    {data: 'action', name: 'action', orderable: true, searchable: true},--}}
{{--                ]--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}

    {{--            $("#active_users").DataTable({--}}
    {{--                // processing: true,--}}
    {{--                // serverSide: true,--}}
    {{--                destroy: true,--}}
    {{--                retrieve: true,--}}
    {{--                "responsive": true,--}}
    {{--                "autoWidth": false,--}}
    {{--                ajax: '{{ route('user.datatable.active') }}',--}}
    {{--                columns: [--}}
    {{--                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
    {{--                    { data: 'first_name', name: 'users.first_name', searchable: true},--}}
    {{--                    { data: 'last_name', name: 'users.last_name', searchable: true},--}}
    {{--                    { data: 'email', name: 'users.email', searchable: true},--}}
    {{--                    { data: 'designation', name: 'unit.name', searchable: true},--}}
    {{--                    { data: 'region', name: 'regions.name', searchable: true},--}}
    {{--                    { data: 'project_list', name: 'projects.title', searchable: true },--}}
    {{--                    { data: 'action', name: 'action', searchable: false },--}}
    {{--                ]--}}
    {{--            });--}}
    {{--        })--}}
    {{--    </script>--}}
@endpush
