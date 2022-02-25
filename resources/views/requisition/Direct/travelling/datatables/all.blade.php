<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
{{--                <h3 class="card-title">TRAVELLING COSTS</h3>--}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="rawquery" >
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


