@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PARTICIPANTS DETAILS</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead >
                        <tr>

                            <th >Full Name</th>
                            <th >Phone</th>
                            <th >Perdiem</th>
                            <th >Transportation</th>
                            <th>Other Cost</th>
                            <th >Total</th>
                            <th >Amount Paid</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $details)
                            <tr>

                                <td>{{$details->user->first_name}} {{$details->user->last_name}}</td>
                                <td>{{$details->user->phone}}</td>
                                <td>{{$details->perdiem_total_amount}}</td>
                                <td>{{$details->transportation}}</td>
                                <td>{{$details->other_cost}}</td>
                                <td>{{$details->total_amount}}</td>
                                <td>{{$details->amount_paid}}</td>
                                <td> @if($details->is_substitute == true)
                                        <span class="tag tag-yellow">Substituted</span>
                                    @endif
                                    @if($details->attend == true)
                                        <span class="tag tag-green">Attended</span>
                                    @endif
                                    @if($details->attend == false)
                                        <span class="tag tag-gray">Not Attended</span>
                                    @endif
                                    @if($details->amount_paid == null)
                                        <span class="tag tag-red">Not Verified</span>
                                    @else
                                        <span class="tag tag-light-green"> Verified</span>
                                        @endif
                                </td>


                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
                        @if($details->attend == true)
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3" style="margin-left: 40%;">Verify Payment </button>

            @endif

                    <!-- Message Modal -->
                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="example-Modal3">Deposit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['route' => ['programactivity.submitPayment',$details->uuid],'method'=>'POST']) !!}
                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">Payment Method:</label>
                                        <select class="form-control" name="payment_method" >
                                            <option value="tigopesa">Tigo Pesa</option>
                                            {{--                    <option value="bank">Bank Transfer</option>--}}
                                        </select>
                                    </div>
                                    <div class="form-group" id="number" >
                                        <label for="recipient-name" class="form-control-label">Account Number:</label>
                                        {!! Form::text('number',$details->user->phone,['class'=>'form-control', 'placeholder'=>'0758698022 or 0J1468300300']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">Total Amount:</label>
                                        {!! Form::number('payed_amount',$details->total_amount,['class'=>'form-control', 'placeholder'=>'100,000', 'id'=>'paid_amount']) !!}
                                    </div>

                                    {!! Form::number('reference',$details->id,['class'=>'form-control', 'hidden']) !!}
                                    {!! Form::number('requested_amount',$details->total_amount,['class'=>'form-control', 'hidden', 'id'=>'requested_amount']) !!}
                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">Remarks:</label>
                                        {!! Form::textarea('remarks',null,['class'=>'form-control', 'placeholder'=>'max 200 words']) !!}
                                    </div>




                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                </div>
@endsection
