<table id="all_experiences" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-15p">ORGANISATION</th>
        <th class="wd-20p">POSITION</th>
        <th class="wd-20p">SUMMARY</th>
        <th class="wd-20p">SUPERVISOR</th>
        <th class="wd-15p">START YEAR</th>
        <th class="wd-10p">END YEAR</th>
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_experiences").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('experience.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'organisation_name', name: 'organisation_name', searchable: true},
                    { data: 'position', name: 'position', searchable: true},
                    { data: 'summary', name: 'summary', searchable: true},
                    { data: 'supervisor', name: 'supervisor', searchable: true},
                    { data: 'start_year', name: 'start_year', searchable: true},
                    { data: 'end_year', name: 'end_year.', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
