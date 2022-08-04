@extends('layouts.app')

@section('content')

    @if($program_activity->done == 0)
    {!! Form::open(['route' => ['programactivity.update',$program_activity]]) !!}
    <div class="row">
        <div class="col-lg-12 mb-3">
    <button type="submit" class="btn btn-primary float-right" >Submit For Approval</button>
    {!! Form::close() !!}
            @elseif($program_activity->done == 1)
                <div class="row">
                    <div class="col-lg-12 mb-3">
                <a href="{{route('programactivity.show', $program_activity)}}" class="btn btn-primary float-right" >Back</a>
                    </div>
                </div>
                @endif
        </div>
    </div>


@include('programactivity.forms.event-schedule.create')

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
                                    Select and add venue based on your priority
                                </div>
                                <div class="card-body">
                                    {!! Form::open(['route' => 'programactivity.storeHotelReservation']) !!}
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
                                            <input type="number" name="program_activity_id" value="{{$program_activity->id}}" hidden class="form-control" >



                                        </div>
                                    </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  col-xl-6">
                            <div class="card">
                                <div class="card-alert alert alert-success mb-0">
                                    Selected venues arranged based on your selection
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @if($hotels_reserved->count() > 0)
                                            @foreach($hotels_reserved as $hotels)
                                                <li class="list-group-item justify-content-between">
                                                      {{$hotels->name}}
                                                    <span class="badgetext badge ">

                                                       <a class="btn btn-outline-danger" href="{{route('programactivity.removeHotel', $hotels->uuid)}}" onclick="if (confirm('Are you sure you want to delete?')){return true} else {return false}"><i class="fa fa-trash text-danger" aria-hidden="true" ></i> Remove</a>


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
                    <h3 class="card-title">Participants</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead >
                            <tr>

                                <th>Name</th>
{{--                                <th>Title</th>--}}
                                <th>Phone</th>
                                <th>Perdiem</th>
                                <th>Transport</th>
                                <th>Others</th>
                                <th>Total</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($training_costs AS $training_costs)
                            <tr>

                                <td>{{$training_costs->user->first_name}} {{$training_costs->user->last_name}}</td>
{{--                                <td>{{$training_costs->user->scale->title}}</td>--}}
                                <td>{{$training_costs->user->phone}}</td>
                                <td>{{number_2_format($training_costs->perdiem_total_amount)}}</td>
                                <td>{{number_2_format($training_costs->transportation)}}</td>
                                <td>{{number_2_format($training_costs->other_cost)}} <span class="text-success">{{$training_costs->others_description}}</span></td>
                                <td>{{number_2_format($training_costs->total_amount)}}</td>


                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Items</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="items" class="table table-striped table-bordered">
                            <thead >
                            <tr>

                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($training_items AS $training_items)
                                <tr>

                                    <td>{{$training_items->title}} </td>
                                    <td>{{$training_items->unit}}</td>
                                    <td>{{$training_items->unit_price}}</td>
                                    <td>{{number_2_format($training_items->total_amount)}}</td>


                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    <!-- table-responsive -->

                </div>
            </div>

        </div>
    </div>
            @push('after-scripts')
                <script>
                    $(document).ready(function (){
                        $("#example").dataTable()
                        $("#items").dataTable()
                    })
                </script>

    @endpush
@endsection



