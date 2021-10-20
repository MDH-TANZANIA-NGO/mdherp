<table id="all_projects" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">CODE</th>
        <th class="wd-20p">TITLE</th>
        <th class="wd-20p">DESCRIPTION</th>
        <th class="wd-20p">PROGRAM AREA</th>
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
                ajax: '{{ route('activity.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'code', name: 'activities.code', searchable: true},
                    { data: 'title', name: 'activities.title', searchable: true},
                    { data: 'description', name: 'activities.description', searchable: true},
                    { data: 'program_area_title', name: 'program_areas.title', searchable: true},
                    { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
