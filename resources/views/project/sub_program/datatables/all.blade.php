<table id="all_projects" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">TITLE</th>
        <th class="wd-20p">DESCRIPTION</th>
        <th class="wd-20p">PROGRAM AREA</th>
        <th class="wd-20p">PROJECT(S)</th>
        <th class="wd-25p">REGISTERED DATE</th>
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
                ajax: '{{ route('sub_program.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'sub_programs.title', searchable: true},
                    { data: 'description', name: 'sub_programs.description', searchable: true},
                    { data: 'program_area_title', name: 'program_areas.title', searchable: true},
                    { data: 'project_list', name: 'projects.title', searchable: true},
                    { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
