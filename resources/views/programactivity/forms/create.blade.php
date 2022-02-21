@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['programactivity.update',$program_activity]]) !!}
    <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit For Approval</button>
    {!! Form::close() !!}
        <div class="offer offer-info mb-6">
            <div class="shape">
                <div class="shape-text">
                </div>
            </div>
            <div class="offer-content">
                <h3 class="lead">
                    @foreach($requisition_training AS $requisition_training)
                        <b>Start Date:</b> {{$requisition_training->from}}   <b>End Date:</b>{{$requisition_training->to}}
                    <br>
                        <b>Location:</b>{{$requisition_training->district->name}}
                    @endforeach

                </h3>
                <p class="mb-0">

                    <br>
                    @foreach($requisition AS $requisition)
                        <b>Description:</b> {{$requisition->description}}
                    @endforeach
                </p>
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
                        <table class="table card-table table-vcenter text-nowrap">
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
                                <td>{{number_2_format($training_costs->other_cost)}}</td>
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
                        <table class="table card-table table-vcenter text-nowrap">
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
@endsection



