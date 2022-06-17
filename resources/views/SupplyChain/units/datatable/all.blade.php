<table id="all_units" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">TITLE</th>
        <th class="wd-20p">ABBREVIATION</th>
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_units").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('unit.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },

                    { data: 'title', name: 'stock_units.title', searchable: true},
                    { data: 'abbreviation', name: 'stock_units.abbreviation', searchable: true},
                      { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
