{{--<!-- Row -->--}}
{{--<div class="row">--}}
{{--    <div class="col-md-12 col-lg-12">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header" style="background-color: rgb(238, 241, 248)">--}}
{{--                                <h3 class="card-title">Summary</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table card-table table-vcenter text-nowrap" id="travellingCosts">--}}
{{--                        <thead  class="bg-secondary text-white">--}}
{{--                        <tr >--}}
{{--                            <th class="text-white">ID</th>--}}
{{--                            <th class="text-white">Participants</th>--}}
{{--                            <th class="text-white">Days</th>--}}
{{--                            <th class="text-white">Perdiem</th>--}}
{{--                            <th class="text-white">Transport</th>--}}
{{--                            <th class="text-white">Others</th>--}}
{{--                            <th class="text-white">Total</th>--}}
{{--                            <th class="text-white">Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($training_costs as $key => $cost)--}}
{{--                            <tr>--}}
{{--                                <th>{{ $key + 1 }}</th>--}}
{{--                                <th>{{ $cost->user->full_name_formatted }}</th>--}}
{{--                                <th>{{ $cost->no_days }}</th>--}}
{{--                                <th>{{ $cost->gRate->amount }}</th>--}}
{{--                                <th>{{ $cost->transportation }}</th>--}}
{{--                                <th>{{ $cost->other_cost }}</th>--}}
{{--                                <th>{{ $cost->total_amount }}</th>--}}
{{--                                <th><a href="" class="btn btn-primary">Edit</a> </th>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <!-- table-responsive -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!--End  Row -->--}}

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


<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PARTICIPANTS LIST</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Name</th>
                        <th>Days</th>
                        <th>Perdiem</th>
                        <th>Transport</th>
                        <th>Others</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>Elinipendo Joshua Mziray</td>
                        <td>10</td>
                        <td>120,000</td>
                        <td>30,000</td>
                        <td>10,000</td>
                        <td><button type="submit" class="btn btn-outline-info">Remove</button></td>
                    </tr>
                    <tr>
                        <td>Joan Powell</td>
                        <td>10</td>
                        <td>120,000</td>
                        <td>30,000</td>
                        <td>10,000</td>
                        <td><button type="submit" class="btn btn-outline-info">Remove</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
</div>


<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ITEMS LIST</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>Elinipendo Joshua Mziray</td>
                        <td>10</td>
                        <td>120,000</td>
                        <td>30,000</td>
                        <td><button type="submit" class="btn btn-outline-info">Remove</button></td>
                    </tr>
                    <tr>
                        <td>Joan Powell</td>
                        <td>10</td>
                        <td>120,000</td>
                        <td>10,000</td>
                        <td><button type="submit" class="btn btn-outline-info">Remove</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
</div>

