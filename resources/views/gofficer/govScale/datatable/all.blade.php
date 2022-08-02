<table id="all_scales" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">TITLE</th>
        {{--         <th class="wd-25p">REGISTERED DATE</th>--}}
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_scales").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('g_scale.datatable.all-gov-scales') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'g_scale.title', searchable: true},
                    // { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
