@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['programactivity.update',$program_activity]]) !!}
    <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit For Approval</button>
    {!! Form::close() !!}
        <div class="offer offer-info mb-6">
    <button type="submit" class="btn btn-primary float-right" >Submit For Approval</button>
    {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Activity Schedule</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>

            <div class="card-body">
                {!! Form::open(['route' => ['training.updateSchedule',$requisition_training->uuid], 'method'=>'POST']) !!}

                {{--    {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required', 'hidden']) !!}--}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}
                            <input type="date" min="{{ now()->toDateString('Y-m-d') }}" class="form-control" name="from" value="{{$requisition_training->start_date}}">
                            {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('to',$requisition_training->end_date,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to']) !!}
                            {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('activity_location', __("Activity Location"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('district_id',$district,$requisition_training->district_id,['class' => 'form-control select2-show-search','required']) !!}
                            {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary" style="margin-left: 40%">Save changes</button>

                {!! Form::close() !!}
            </div>
        </div>

        </div>
    </div>


{{--        <div class="offer offer-info mb-6">
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
        </div>--}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Participants</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
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



