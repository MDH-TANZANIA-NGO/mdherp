<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-12" >

                <div class="table-responsive">
                    <table id="budgets_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">Activity</th>
                            <th class="wd-15p">AMOUNT</th>
                            <th class="wd-20p">REGIONS</th>
                            <th class="wd-15p">FISCAL YEAR</th>
                            <th class="wd-10p">ACTION</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#budgets_table").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('project.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'code', name: 'projects.code', searchable: true},
                    { data: 'title', name: 'projects.title', searchable: true},
                    { data: 'type', name: 'code_values.name', searchable: true},
                    { data: 'regions_count', name: 'regions_count', searchable: true},
                    // { data: 'description', name: 'projects.description', searchable: true},
                    { data: 'start_year', name: 'projects.start_year', searchable: true},
                    { data: 'end_year', name: 'projects.end_year.', searchable: true },
                    // { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
