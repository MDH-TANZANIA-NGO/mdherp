<div class="row">
    <div class="col-12">
        <table id="all_fiscal_year" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th class="wd-15p">#</th>
                <th class="wd-20p">{{ __('label.title') }}</th>
                <th class="wd-20p">{{ __('label.start_date') }}</th>
                <th class="wd-20p">{{ __('label.end_date') }}</th>
                <th class="wd-20p">{{ __('label.total_amount') }}</th>
                <th class="wd-20p">{{ __('label.status') }}</th>
                <th class="wd-10p">MORE</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_fiscal_year").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('fiscal_year.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'fiscal_year.title', searchable: true},
                    { data: 'from_at', name: 'fiscal_year.from_at', searchable: true},
                    { data: 'to_at', name: 'fiscal_year.to_at', searchable: true},
                    { data: 'total_amount', name: 'total_amount', searchable: true},
                    { data: 'status', name: 'fiscal_year.active', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
