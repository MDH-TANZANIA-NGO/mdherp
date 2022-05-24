<div class="row">
    <div class="col-12">
        <table id="all_fiscal_year" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th class="wd-15p">#</th>
                <th class="wd-20p">{{ __('1 USD equal to TSH') }}</th>
                <th class="wd-20p">{{ __('label.date') }}</th>
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
                ajax: '{{ route('rate.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'amount', name: 'rates.title', searchable: true},
                    { data: 'created_at', name: 'rates.created_at', searchable: false},
                    { data: 'status', name: 'rates.status', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
