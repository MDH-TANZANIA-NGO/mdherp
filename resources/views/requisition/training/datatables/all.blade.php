<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TRAINING COSTS</h3>
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
                            <th class="text-white">Participant</th>
                            <th class="text-white">Days</th>
                            <th class="text-white">Perdiem</th>
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
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('training.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'user_id', name: 'training_costs.user_id', searchable: true},
                    { data: 'no_days', name: 'training_costs.no_days', searchable: true},
                    { data: 'perdiem_rate', name: 'training_costs.perdiem_rate', searchable: true},
                    { data: 'transportation', name: 'training_costs.transportation', searchable: true},
                    { data: 'other_cost', name: 'training_costs.other_cost', searchable: true },
                    { data: 'total_amount', name: 'training_costs.total_amount', searchable: true },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
