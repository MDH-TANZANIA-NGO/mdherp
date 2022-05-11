
@foreach($travelling_costs as $cost)

        <div class="card">
            <div class="card-header">
                <div class="tags">

                    <div class="tag">
                        Traveller's name
                        <span class="tag-addon tag-success">{{$cost->user->first_name}} {{$cost->user->last_name}}</span>
                    </div>
                    <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                        {{$cost->from}}
                        <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                    </div>
                    <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                        {{$cost->to}}
                        <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                    </div>

                    <div class="tag">
                        Total travelling cost
                        <span class="tag-addon tag-success">{{number_2_format($cost->total_amount)}}</span>
                    </div>
                    <div class="tag">
                        Total perdiem
                        <span class="tag-addon tag-success">{{number_2_format($cost->perdiem_total_amount)}}</span>
                    </div>
                    <div class="tag">
                        Total accommodation
                        <span class="tag-addon tag-success">{{number_2_format($cost->accommodation)}}</span>
                    </div>

                </div>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                @if($trips->count() > 0)
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="text-center" >Destination</th>
                                <th class="text-center" >Departure</th>
                                <th class="text-center" >Returning</th>
                                <th class="text-right" style="width: 1%">Perdiem</th>
                                <th class="text-right" style="width: 1%">Ontransit</th>
                                <th class="text-right" style="width: 1%">Accomodation</th>
                                <th class="text-right" style="width: 1%">Transportation</th>
                                <th class="text-right" style="width: 1%">Others</th>
                                <th class="text-right" style="width: 1%">Total</th>
                            </tr>

                            @foreach($trips as $cost)
                                <tr>
                                    <td>
                                        <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{$cost->district->name}}</div>
                                    </td>
                                    <td class="text-center">{{ date('d-M-Y', strtotime($cost->from)) }}</td>
                                    <td class="text-center">{{ date('d-M-Y', strtotime($cost->to)) }}</td>
                                    <td class="text-right">{{ number_2_format($cost->perdiem_total_amount )}}</td>
                                    <td class="text-right">{{ number_2_format($cost->ontransit )}}</td>
                                    <td class="text-right">{{ number_2_format($cost->accommodation )}}</td>
                                    <td class="text-right">{{ number_2_format($cost->transportation) }}</td>
                                    <td class="text-right">{{ number_2_format($cost->other_cost) }}   <div class="nn" style="color: green">{{ $cost->others_description }}</div></td>

                                    <td class="text-right">{{ number_2_format($cost->total_amount) }}</td>
                                </tr>
                            @endforeach

                            {{--                        <tr>--}}
                            {{--                            <td colspan="6" class="font-w600 text-right">Total TZS</td>--}}
                            {{--                            <td class="text-right">240,000.00</td>--}}
                            {{--                        </tr>--}}
                            <tr>
                                <td colspan="8" class="font-weight-regular text-uppercase text-right">Sub Total </td>
                                <td class="font-weight-regular text-right">{{ number_2_format($requisition->amount) }}</td>
                            </tr>

                        </table>
                    </div>
                @else
                    No Trips Available
                @endif
            </div>
        </div>


@endforeach
<!-- Row-->
{{--<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">More Details</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">



                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr class=" ">
                            <th>Traveller's Info</th>
                            <th class="text-center" >Departure</th>
                            <th class="text-center" >Returning</th>
                            <th class="text-right" style="width: 1%">Perdiem</th>
                            <th class="text-right" style="width: 1%">Ontransit</th>
                            <th class="text-right" style="width: 1%">Accomodation</th>
                            <th class="text-right" style="width: 1%">Transportation</th>
                            <th class="text-right" style="width: 1%">Others</th>
                            <th class="text-right" style="width: 1%">Total</th>
                        </tr>

                        @foreach($travelling_costs as $cost)
                        <tr>
                            <td>
                                {{ $cost->user->full_name_formatted }}</p>
                                <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>Mlandizi</div>
                            </td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($cost->from)) }}</td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($cost->to)) }}</td>
                            <td class="text-right">{{ number_2_format($cost->perdiem_total_amount )}}</td>
                            <td class="text-right">{{ number_2_format($cost->ontransit )}}</td>
                            <td class="text-right">{{ number_2_format($cost->accommodation )}}</td>
                            <td class="text-right">{{ number_2_format($cost->transportation) }}</td>
                            <td class="text-right">{{ number_2_format($cost->other_cost) }}   <div class="nn" style="color: green">{{ $cost->others_description }}</div></td>

                            <td class="text-right">{{ number_2_format($cost->total_amount) }}</td>
                        </tr>
                        @endforeach

--}}{{--                        <tr>--}}{{--
--}}{{--                            <td colspan="6" class="font-w600 text-right">Total TZS</td>--}}{{--
--}}{{--                            <td class="text-right">240,000.00</td>--}}{{--
--}}{{--                        </tr>--}}{{--
                        <tr>
                            <td colspan="8" class="font-weight-bold text-uppercase text-right">Total </td>
                            <td class="font-weight-bold text-right">{{ number_2_format($requisition->amount) }}</td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-right">
--}}{{--                                <button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-folder-alt"></i> Save </button>--}}{{--
--}}{{--                                <button type="button" class="btn btn-secondary" onClick="javascript:window.print();"><i class="si si-paper-plane"></i> Submit</button>--}}{{--
                                <button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print </button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>--}}


