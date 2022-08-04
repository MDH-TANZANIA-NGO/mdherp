<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payments</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table id="payment_table" class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Full name</th>
                                <th>Phone</th>
                                <th>Days</th>
                                <th>Perdiem</th>
                                <th>Transportation</th>
                                <th>Others</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>



                            @foreach($training_costs as $key=>$training_cost)
                            <tr data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle">
                                {{dd($key)}}
                                <td><button class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i></button></td>
                                <td>{{$training_cost->user->first_name}} {{$training_cost->user->last_name}}</td>
                                <td>{{$training_cost->user->phone}}</td>
                                <td>0/10</td>
                                <td>{{number_2_format($training_cost->perdiem_total_amount)}}</td>
                                <td>{{number_2_format($training_cost->transportation)}}</td>
                                <td>{{number_2_format($training_cost->other_cost)}}</td>
                                <td>{{number_2_format($training_cost->total_amount)}}</td>
                                <td><input type="number" class="form-control" name="amount_paid" value="{{$training_cost->amount_paid}}"></td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Swap participant"><i class="fa fa-exchange"></i></a> | <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove participant"><i class="fa fa-close"></i></a></td>
                            </tr>

                            <tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordian-body collapse" id="demo{{$key}}">
                                        @endforeach
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>Hotspot</th>
                                                <th>Date</th>
                                                <th>Time in</th>
                                                <th>Time out</th>
                                                <th>Checkin location</th>
                                                <th>Checkout location</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($attendances->getGOfficerAttendancesById($training_cost->participant_uid)->get() as $attendance)
                                            <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                                <td> {{$attendance->camp}}</td>
                                                <td>{{date('d-m-Y', strtotime($attendance->checkin_time))}}</td>
                                                <td>{{date('Gi.s', strtotime($attendance->checkin_time))}}</td>
                                                <td>{{date('Gi.s', strtotime($attendance->checkout_time))}}</td>
                                                <td>{{$attendance->checkin_location}}</td>
                                                <td>{{$attendance->checkout_location}}</td>
                                            </tr>
                                            @endforeach



                                            </tbody>
                                        </table>

                                    </div>
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td colspan="11" class="hiddenRow"><div id="demo2" class="accordian-body collapse">No attendance available</div></td>--}}
{{--                            </tr>--}}

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>


</div>

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#payment_table").dataTable({
                pagingType: 'full_numbers',
            })

        })

        </script>
@endpush


