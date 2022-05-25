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

                            <th>From</th>
                            <th>To</th>
                            <th>Perdiem</th>
                            <th>Destination</th>
                            <th>Accommodation</th>
                            <th>Transport</th>
                            <th>Ticket Fair</th>
                            <th>Others</th>
                            <th>Total</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trip_details as  $cost)
                            <tr>
                                <th>{{ $cost->from}}</th>
                                <th>{{ $cost->to }}</th>
                                <th>{{ number_2_format($cost->perdiem_total_amount) }}</th>
                                <th>{{ $cost->district->name}}</th>
                                <th>{{ number_2_format($cost->total_accommodation) }}</th>
                                <th>{{ number_2_format($cost->transportation) }}</th>
                                <th>{{ number_2_format($cost->ticket_fair) }}</th>
                                <th>{{ number_2_format($cost->other_cost) }}</th>
                                <th>{{ number_2_format($cost->total_amount) }}</th>
                                <th><a href="{{route('trip.edit', $cost->uuid)}}" class="btn btn-primary" ><i class="fa fa-edit"></i></a> <a href="{{route('trip.delete',$cost->uuid)}}" class="btn btn-danger" onclick="if (confirm('Are you sure you want to delete?')){return true} else {return false}"><i class="fa fa-trash"></i></a> </th>
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
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#rawquery").dataTable()
        })
    </script>

@endpush


