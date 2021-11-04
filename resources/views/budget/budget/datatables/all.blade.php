<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-12" >

                <div class="table-responsive">
                    <table id="budgets_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-15p">ACTIVITY</th>
                            <th class="wd-15p">FISCAL YEAR</th>
                            <th class="wd-20p">REGIONS</th>
                            <th class="wd-15p">AMOUNT</th>
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
                ajax: '{{ route('budget.datatable.all_active') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'activity_title', name: 'activities.title', searchable: true},
                    { data: 'fiscal_year', name: 'fiscal_years.title', searchable: true},
                    { data: 'region_list', name: 'regions.name', searchable: true},
                    { data: 'total_amount', name: 'total_amount', searchable: true},
                ]
            });
        })
    </script>
@endpush
