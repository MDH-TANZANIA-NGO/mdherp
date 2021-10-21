<table id="all_projects" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-15p">CODE</th>
        <th class="wd-20p">TITLE</th>
        <th class="wd-20p">TYPE</th>
        <th class="wd-20p"># REGIONS</th>
        {{-- <th class="wd-20p">DESCRIPTION</th> --}}
        <th class="wd-15p">START YEAR</th>
        <th class="wd-10p">END YEAR</th>
        {{-- <th class="wd-25p">REGISTERED DATE</th> --}}
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
