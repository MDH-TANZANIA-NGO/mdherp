<table id="all_grates" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">AMOUNT</th>
{{--         <th class="wd-25p">TITLE</th>--}}
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_grates").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('g_rate.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'amount', name: 'g_rates.amount', searchable: true},
                    // { data: 'g_scale_title', name: 'g_scale_title', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
