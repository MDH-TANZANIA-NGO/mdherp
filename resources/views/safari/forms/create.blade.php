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
                                <th>Accomodation</th>
                                <th>Transport</th>
                                <th>Ontransit</th>
                                <th>Others</th>
                                <th>Total</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>{{$travelling_cost->user->full_name}}</td>
                                <td>{{$travelling_cost->no_days}}</td>
                                <td>{{number_2_format($travelling_cost->perdiem_total_amount)}}</td>
                                <td>{{number_2_format($travelling_cost->accommodation)}}</td>
                                <td>{{number_2_format($travelling_cost->transportation)}}</td>
                                <td>{{number_2_format($travelling_cost->ontransit)}}</td>
                                <td>{{number_2_format($travelling_cost->other_cost)}}</td>
                                <td>{{number_2_format($travelling_cost->total_amount)}}</td>
                            </tr>
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
                                    <th>Means of Transport</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{!! Form::select('district_id',null,$travelling_cost->district_id,['class' => 'form-control select2-show-search','required']) !!}</td>
                                    <td>
                                        <select name="transport_means" class="form-control">
                                            <option value="flight">Flight</option>
                                            <option value="vehicle">MDH Vehicle</option>
                                        </select>
                                    </td>
                                    <td>{!! Form::date('from', $travelling_cost->from, ['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::date('to', $travelling_cost->to, ['class' => 'form-control', 'required']) !!}</td>
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
