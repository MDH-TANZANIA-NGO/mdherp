<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
{{--                <h3 class="card-title">TRAVELLING COSTS</h3>--}}
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary" id="travellingCosts">
                        <thead  class="bg-primary text-white">
                        <tr >
                            <th class="text-white">ID</th>
                            <th class="text-white">Travellor</th>
                            <th class="text-white">Days</th>
                            <th class="text-white">Meals & Incidentals</th>
                            <th class="text-white">Accomodation</th>
                            <th class="text-white">Transport</th>
                            <th class="text-white">Others</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>
<!--End  Row -->

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#travellingCosts").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('travelling.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'user_id', name: 'travelling_costs.user_id', searchable: true},
                    { data: 'no_days', name: 'travelling_costs.no_days', searchable: true},
                    { data: 'perdiem_rate', name: 'travelling_costs.perdiem_rate', searchable: true},
                    { data: 'accomodation', name: 'travelling_costs.accomodation', searchable: true},
                    { data: 'transportation', name: 'travelling_costs.transportation', searchable: true},
                    { data: 'other_cost', name: 'travelling_costs.other_cost', searchable: true },
                    { data: 'total_amount', name: 'travelling_costs.total_amount', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
