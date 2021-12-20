@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Request Summary</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead >
                            <tr>

                                <th>Name</th>
                                <th>Duration</th>
                                <th>Perdiem</th>
                                <th>Transport</th>
                                <th>Others</th>
                                <th>Ontransit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $participants)
                                <tr>

                                    <td>{{$participants->traveller_uid}}</td>
                                    <td>{{$participants->no_days}}</td>
                                    <td>{{$participants->perdiem_total_amount}}</td>
                                    <td>{{$participants->transportation}}</td>
                                    <td>{{$participants->other_cost}}</td>
                                    <td><button type="submit" class="btn btn-outline-info">Remove</button></td>
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
                    <h3 class="card-title">Safari Advance Form</h3>
                </div>
                {!! Form::open(['route' => ['safari.index']]) !!}
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('item_name', __("Scope of Work"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::textarea('title', null, ['class' => 'form-control', 'required']) !!}
                                {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead >
                                <tr>

                                    <th>Destination</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>{!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::date('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::date('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                </tr>
                                <tr>

                                    <td>{!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::date('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::date('title', null, ['class' => 'form-control', 'required']) !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive -->

                        <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Submit For Approval</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @include('safari.forms.initiate')--}}


@endsection
