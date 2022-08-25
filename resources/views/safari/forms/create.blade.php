@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-header">
            <div class="tags">

                <div class="tag">
                    Traveller's name
                    <span class="tag-addon tag-success">{{$travelling_cost->user->first_name}} {{$travelling_cost->user->last_name}}</span>
                </div>
                <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                    {{$travelling_cost->from}}
                    <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                </div>
                <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                    {{$travelling_cost->to}}
                    <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                </div>

                <div class="tag">
                    Total travelling cost
                    <span class="tag-addon tag-success">{{number_2_format($travelling_cost->total_amount)}}</span>
                </div>
                <div class="tag">
                    Total perdiem
                    <span class="tag-addon tag-success">{{number_2_format($travelling_cost->perdiem_total_amount)}}</span>
                </div>
                <div class="tag">
                    Total accommodation
                    <span class="tag-addon tag-success">{{number_2_format($travelling_cost->accommodation)}}</span>
                </div>
                <div class="tag">
                    Ontransit
                    <span class="tag-addon tag-success">{{number_2_format($travelling_cost->ontransit)}}</span>
                </div>

            </div>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            @if($travelling_cost->trips->count() > 0)
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="text-center" >Destination</th>
                            <th class="text-center" >Departure</th>
                            <th class="text-center" >Returning</th>
                            <th class="text-right" style="width: 1%">Perdiem</th>
                            <th class="text-right" style="width: 2%">Ticket</th>
                            <th class="text-right" style="width: 1%">Accomodation</th>
                            <th class="text-right" style="width: 1%">Transportation</th>
                            <th class="text-right" style="width: 1%">Others</th>
                            <th class="text-right" style="width: 1%">Total</th>
                        </tr>

                        @foreach($travelling_cost->trips as $trips)
                            <tr>
                                <td>
                                    <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{$trips->district->name}}</div>
                                </td>
                                <td class="text-center">{{ date('d-M-Y', strtotime($trips->from)) }}</td>
                                <td class="text-center">{{ date('d-M-Y', strtotime($trips->to)) }}</td>
                                <td class="text-right">{{ number_2_format($trips->perdiem_total_amount )}}</td>
                                <td class="text-right">{{ number_2_format($trips->ticket_fair )}}</td>
                                <td class="text-right">{{ number_2_format($trips->total_accommodation )}}</td>
                                <td class="text-right">{{ number_2_format($trips->transportation) }}</td>
                                <td class="text-right">{{ number_2_format($trips->other_cost) }}   <div class="nn" style="color: green">{{ $trips->others_description }}</div></td>

                                <td class="text-right">{{ number_2_format($trips->total_amount) }}</td>
                            </tr>
                        @endforeach

                        {{--                        <tr>--}}
                        {{--                            <td colspan="6" class="font-w600 text-right">Total TZS</td>--}}
                        {{--                            <td class="text-right">240,000.00</td>--}}
                        {{--                        </tr>--}}
                        <tr>
                            <td colspan="8" class="font-weight-bold text-uppercase text-right"> Total </td>
                            <td class="font-weight-bold text-right">{{ number_2_format($travelling_cost->total_amount) }}</td>
                        </tr>

                    </table>
                </div>
            @else
                {{--                    {{$cost}}--}}
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="text-center" >Destination</th>
                            <th class="text-center" >Departure</th>
                            <th class="text-center" >Returning</th>
                            <th class="text-right" style="width: 1%">Perdiem</th>
                            <th class="text-right" style="width: 2%">Ticket</th>
                            <th class="text-right" style="width: 1%">Accomodation</th>
                            <th class="text-right" style="width: 1%">Transportation</th>
                            <th class="text-right" style="width: 1%">Others</th>
                            <th class="text-right" style="width: 1%">Total</th>
                        </tr>

                        <tr>
                            <td>
                                <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{$travelling_cost->district->name}}</div>
                            </td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($travelling_cost->from)) }}</td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($travelling_cost->to)) }}</td>
                            <td class="text-right">{{ number_2_format($travelling_cost->perdiem_total_amount )}}</td>
                            <td class="text-right">{{ number_2_format($travelling_cost->ticket_fair )}}</td>
                            <td class="text-right">{{ number_2_format($travelling_cost->accommodation )}}</td>
                            <td class="text-right">{{ number_2_format($travelling_cost->transportation) }}</td>
                            <td class="text-right">{{ number_2_format($travelling_cost->other_cost) }}   <div class="nn" style="color: green">{{ $travelling_cost->others_description }}</div></td>

                            <td class="text-right">{{ number_2_format($travelling_cost->total_amount) }}</td>
                        </tr>

                        <tr>
                            <td colspan="8" class="font-weight-bold text-uppercase text-right"> Total </td>
                            <td class="font-weight-bold text-right">{{ number_2_format($travelling_cost->total_amount) }}</td>
                        </tr>

                    </table>
                </div>
            @endif
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header" style="background-color: rgb(238, 241, 248)">--}}
{{--                    <h3 class="card-title">Logistics Arrangements</h3>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <!-- Row -->--}}
{{--                    <div class="row">--}}
{{--                        @if($hotels->count() > 0)--}}
{{--                        <div class="col-sm-12 col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">Hotel Reservation</h3>--}}
{{--                                    <div class="card-options ">--}}
{{--                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
{{--                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    {!! Form::open(['route' => 'safari.storeHotelReservation','class'=>'card']) !!}--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group ">--}}
{{--                                                    {!! Form::label('hotel', __("Choose Hotel"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                                    {!! Form::select('hotel_id', $hotels, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
{{--                                                    {!! $errors->first('hotel_id', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group ">--}}
{{--                                                    {!! Form::label('hotel', __("Priority Level"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                                  <select name="priority_level" class="form-control">--}}
{{--                                                      <option value="1">First</option>--}}
{{--                                                      <option value="2">Second</option>--}}
{{--                                                      <option value="3">Third</option>--}}
{{--                                                      <option value="4">Fourth</option>--}}
{{--                                                  </select>--}}
{{--                                                    {!! $errors->first('hotel_id', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--<input type="number" name="safari_advance_id" value="{{$safari_advance->id}}" hidden class="form-control" >--}}

{{--                                            <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    {!! Form::close() !!}--}}
{{--                                    <ul class="list-group">--}}
{{--                                        @if($hotels_reserved->count() > 0)--}}
{{--                                            @foreach($hotels_reserved as $hotels)--}}
{{--                                                <li class="list-group-item justify-content-between">--}}
{{--                                                    <a class="btn btn-outline-danger" href="{{route('safari.removeHotel', $hotels->uuid)}}" onclick="if (confirm('Are you sure you want to delete?')){return true} else {return false}"><i class="fa fa-trash text-danger" aria-hidden="true" ></i></a> {{$hotels->name}}--}}
{{--                                                    <span class="badgetext badge badge-primary badge-pill">--}}
{{--                                                        @if($hotels->priority_level == 1)--}}
{{--                                                            First--}}
{{--                                                        @elseif($hotels->priority_level == 2)--}}
{{--                                                            Second--}}
{{--                                                        @elseif($hotels->priority_level == 3)--}}
{{--                                                        Third--}}
{{--                                                        @elseif($hotels->priority_level == 4)--}}
{{--                                                        Fourth--}}
{{--                                                            @endif--}}


{{--                                                    </span>--}}


{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        @else--}}
{{--                                            No hotel reserved--}}
{{--                                        @endif--}}
{{--                                        @if($hotels_reserved->count() > 0)--}}


{{--                                            @endif--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <!-- End Row -->--}}
{{--                    <!-- table-responsive -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Logistics Arrangements</h3>
                </div>
                <div class="card-body">
                    @if($hotels->count() > 0)
                        <div class="row">
                            <div class="col-md-12  col-xl-6">
                                <div class="card">

                                    <div class="card-alert alert alert-info mb-0">
                                        Select and add hotel based on your priority
                                    </div>
                                    <div class="card-body">
                                        {!! Form::open(['route' => 'safari.storeHotelReservation']) !!}
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="form-group " style="width: 100%;">
                                                    {{--                                                        {!! Form::label('hotel', __("Choose Hotel"),['class'=>'form-label','required_asterik']) !!}--}}
                                                    {!! Form::select('hotel_id', $hotels, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                    {!! $errors->first('hotel_id', '<span class="badge badge-danger">:message</span>') !!}
                                                </div>
                                                <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-plus-circle mr-2"></i>Add Venue</button>
                                                <select name="priority_level" class="form-control" hidden>
                                                    <option value="1">First</option>
                                                    <option value="2">Second</option>
                                                    <option value="3">Third</option>
                                                    <option value="4">Fourth</option>
                                                </select>
                                                <input type="number" name="safari_advance_id" value="{{$safari_advance->id}}" hidden class="form-control" >



                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  col-xl-6">
                                <div class="card">
                                    <div class="card-alert alert alert-success mb-0">
                                        Selected hotels based on your priority
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @if($hotels_reserved->count() > 0)
                                                @foreach($hotels_reserved as $hotels)
                                                    <li class="list-group-item justify-content-between">
                                                        {{$hotels->name}}
                                                        <span class="badgetext badge ">

                                                       <a class="btn btn-outline-danger" href="{{route('safari.removeHotel', $hotels->uuid)}}" onclick="if (confirm('Are you sure you want to remove hotel?')){return true} else {return false}"><i class="fa fa-trash text-danger" aria-hidden="true" ></i> Remove</a>


                                                    </span>


                                                    </li>
                                                @endforeach
                                            @else
                                                No hotel reserved
                                            @endif
                                            @if($hotels_reserved->count() > 0)


                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif

                <!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Safari Advance Form</h3>
                </div>
                {!! Form::open(['route' => ['safari.update',$safari_advance]]) !!}
                <div class="card-body">
                    <div class="row">
                        {!! Form:: text('safari_advance_id', $safari_advance->id,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('perdiem', $travelling_cost->perdiem_total_amount,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('ontransit', $travelling_cost->ontranist,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('accommodation', $travelling_cost->accommodation,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('transportation', $travelling_cost->transportation,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('other_costs', $travelling_cost->other_cost,['class'=>'form-control','hidden'])!!}
                        {!! Form:: text('district_id', $travelling_cost->district_id,['class'=>'form-control','hidden'])!!}
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('item_name', __("Scope of Work"),['class'=>'form-label','required_asterik']) !!}<span class="text-default text font-weight-light"><i>You can copy from your word document and paste it here.</i></span>
                                {!! Form::textarea('scope', null, ['class'=>'content']) !!}
                                {!! $errors->first('scope', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead >
                                <tr>

                                    <th>Destination</th>
                                    <th>Means of Transport</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> {!! Form::select('district_id',$district, $travelling_cost->district_id, ['class' => 'form-control select2-show-search', 'required', 'disabled']) !!}</td>
                                    <td>
                                        {!! Form::select('transport_means', $transport_means, null, ['class' =>'form-control select2-show-search ', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                       {{-- <select name="transport_means" class="form-control">
                                            <option value="flight">Flight</option>
                                            <option value="vehicle">MDH Vehicle</option>
                                            <option value="public_transport">Public Transport</option>
                                            <option value="sea_transport">Land Public Transport</option>
                                        </select>--}}
                                    </td>
                                    </td>
                                    <td>
{{--                                        {!! Form::date('from', $travelling_cost->from, ['class' => 'form-control', 'required', 'id'=>'from']) !!}--}}
                                    <input type="date" min="{{ now()->toDateString('Y-m-d') }}" name="from" value="{{$travelling_cost->from}}" class="form-control">
                                    </td>
                                    <td>{!! Form::date('to', $travelling_cost->to, ['class' => 'form-control', 'required','id'=>'to']) !!}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive -->

                        <p id="output"></p>

                        <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit For Approval</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @include('safari.forms.initiate')--}}


@endsection

@push('after-scripts')
    <script>

    </script>
@endpush


