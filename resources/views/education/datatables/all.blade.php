<table id="all_educations" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-15p">INSTITUTION</th>
        <th class="wd-20p">AWARD RECEIVED</th>
        <th class="wd-15p">START YEAR</th>
        <th class="wd-10p">END YEAR</th>
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_educations").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('education.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'institution_name', name: 'institution_name', searchable: true},
                    { data: 'award_received', name: 'award_received', searchable: true},
                    { data: 'start_year', name: 'start_year', searchable: true},
                    { data: 'end_year', name: 'end_year.', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
