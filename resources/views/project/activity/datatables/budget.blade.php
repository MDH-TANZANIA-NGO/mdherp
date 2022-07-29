<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-12" >

                <div class="table-responsive">
                    <table id="budgets_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-15p">FISCAL YEAR</th>
                            <th class="wd-20p">{{ __('label.region') }}</th>
                            <th class="wd-15p">NUMERIC OUTPUT</th>
                            <th class="wd-15p">{{ __('label.total_amount') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#budgets_table").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('budget.datatable.budgetByActivity') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'fiscal_year', name: 'fiscal_years.title', searchable: true},
                    { data: 'region_list', name: 'regions.name', searchable: true},
                    { data: 'numeric_output_sum', name: 'numeric_output_sum', searchable: true},
                    { data: 'total_amount', name: 'total_amount', searchable: true},
                    { data: 'action', name: 'action', searchable: false},
                ]
            });
        })
    </script>
@endpush
