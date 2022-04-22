<table id="all_projects" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">NAMES</th>
        <th class="wd-25p">CHECK NO</th>
        <th class="wd-10p">PHONE</th>
        <th class="wd-25p">TITLE</th>
        <th class="wd-25p">REGION</th>
        <th class="wd-25p">FACILITY</th>

        <th class="wd-10p">ACTION</th>

    </tr>
    </thead>
</table>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_projects").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('g_officer.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'names', name: 'names', searchable: true},
                    { data: 'check_no', name: 'g_officers.email', searchable: true},
                    { data: 'phone', name: 'g_officers.phone', searchable: true},
                    { data: 'g_scale_title', name: 'g_scales.title', searchable: true},
                    { data: 'region_name', name: 'regions.name', searchable: true},
                    { data: 'facilities', name: 'facilities.name', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
