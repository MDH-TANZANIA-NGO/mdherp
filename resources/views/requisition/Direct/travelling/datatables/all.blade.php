<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
{{--                <h3 class="card-title">TRAVELLING COSTS</h3>--}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th>ID</th>
                            <th>Travellor</th>
                            <th>Days</th>
                            <th>Meals & Incidentals</th>
                            <th>Accomodation</th>
                            <th>Transport</th>
                            <th>Others</th>
                            <th>Total</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($travelling_costs as $key => $cost)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <th>{{ $cost->user->full_name_formatted }}</th>
                                <th>{{ $cost->no_days }}</th>
                                <th>{{ $cost->perdiem_total_amount }}</th>
                                <th>{{ $cost->accommodation }}</th>
                                <th>{{ $cost->transportation }}</th>

                                <th>{{ $cost->other_cost }}</th>
                                <th>{{ $cost->total_amount }}</th>
                                <th><a href="{{route('travelling.edit',$cost->uuid)}}" class="btn btn-primary" onclick="confirm('Are you sure?')">Edit</a> </th>
                            </tr>
                        </tbody>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>
<!--End  Row -->

{{--@push('after-scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $("#travellingCosts").DataTable({--}}
{{--                // processing: true,--}}
{{--                // serverSide: true,--}}
{{--                destroy: true,--}}
{{--                retrieve: true,--}}
{{--                "responsive": true,--}}
{{--                "autoWidth": false,--}}
{{--                ajax: '{{ route('travelling.datatable.all') }}',--}}
{{--                columns: [--}}
{{--                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },--}}
{{--                    { data: 'user_id', name: 'requisition_travelling_costs.user_id', searchable: true},--}}
{{--                    { data: 'no_days', name: 'requisition_travelling_costs.no_days', searchable: true},--}}
{{--                    { data: 'perdiem_rate', name: 'requisition_travelling_costs.perdiem', searchable: true},--}}
{{--                    { data: 'accommodation', name: 'requisition_travelling_costs.accommodation', searchable: true},--}}
{{--                    { data: 'transportation', name: 'requisition_travelling_costs.transportation', searchable: true},--}}
{{--                    { data: 'other_cost', name: 'requisition_travelling_costs.others', searchable: true },--}}
{{--                    { data: 'total_amount', name: 'requisition_travelling_costs.total_amount', searchable: true },--}}
{{--                    { data: 'action', name: 'action', searchable: false },--}}
{{--                ]--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
