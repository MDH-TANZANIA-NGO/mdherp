<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#userbiodiv" class="active" data-toggle="tab">Users <span class="badge badge-warning">{{$active_user_count}}</span></a></li>
                </ul>
            </div>

        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="userbiodiv">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="userbio" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">First name</th>
                                    <th class="wd-15p">Last name</th>
                                    <th class="wd-20p">Email</th>
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
        $(document).ready(function () {

            $("#userbio").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('userbio.datatable.active') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'first_name', name: 'users.first_name', searchable: true},
                    { data: 'last_name', name: 'users.last_name', searchable: true},
                    { data: 'email', name: 'users.email', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
