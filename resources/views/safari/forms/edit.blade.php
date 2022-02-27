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
                                <th>Ticket Fair</th>
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
                                <td>{{number_2_format($travelling_cost->ticket_fair)}}</td>
                                <td>{{number_2_format($travelling_cost->ontransit)}}</td>
                                <td>{{number_2_format($travelling_cost->other_cost)}} <span>{{$travelling_cost->others_description}}</span></td>
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
                                {!! Form::textarea('scope', $safari_advance->scope, ['class'=>'content']) !!}
                                {!! $errors->first('scope', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead >
                                <tr>

                                    <th>Destination</th>
                                    <th>Means of Transport</th>
                                    <th>Departure</th>
                                    <th>Return</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> {!! Form::select('district_id',$district, $travelling_cost->district_id, ['class' => 'form-control select2-show-search', 'required', 'disabled']) !!}</td>
                                    <td>
                                        <select name="transport_means" class="form-control">
                                            <option value="flight">Flight</option>
                                            <option value="mdh_vehicle">MDH Vehicle</option>
                                            <option value="land_public_transport">Land Public Transport</option>
                                            <option value="boat">Boat</option>
                                        </select>
                                    </td>
                                    </td>
                                    @if($safari_advance_details == null)
                                    <td>{!! Form::date('from', $travelling_cost->from, ['class' => 'form-control', 'required', 'id'=>'from']) !!}</td>
                                    <td>{!! Form::date('to', $travelling_cost->to, ['class' => 'form-control', 'required','id'=>'to']) !!}</td>
                                    @else
                                        <td>{!! Form::date('from', $safari_advance_details->from, ['class' => 'form-control', 'required', 'id'=>'from']) !!}</td>
                                        <td>{!! Form::date('to', $safari_advance_details->to, ['class' => 'form-control', 'required','id'=>'to']) !!}</td>
                                    @endif
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


