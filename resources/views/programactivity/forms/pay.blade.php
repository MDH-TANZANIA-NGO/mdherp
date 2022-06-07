@extends('layouts.app')
@section('content')
    @foreach($details as $details)
        <!-- Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('requisition.show', $requisition->uuid)}}"><h3 class="card-title">{{$requisition->number}}</h3></a>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h4 class="mb-1"><strong>{{$details->user->first_name}} {{$details->user->last_name}}</strong>,</h4>
                            Requires to be paid  <strong>{{number_2_format($details->total_amount)}}</strong> (TZS)
                        </div>

                        <div class="card-body pl-0 pr-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Activity No.</span><br>
                                    <a href="{{route('programactivity.show',$program_activity->uuid)}}" ><strong>{{$program_activity->number}}</strong></a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Requested Date</span><br>
                                    <strong>{{date('d-M-Y', strtotime($program_activity->created_at))}}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row pt-4">
                            <div class="col-lg-6 ">
                                <p class="h3">Activity Info</p>
                                <address>
                                    Activity Location: {{$program_activity->training->district->name}}<br>
                                    Start Date: {{date('d-M-Y', strtotime($program_activity->training->start_date))}}<br>
                                    End Date: {{date('d-M-Y', strtotime($program_activity->training->end_date))}}<br>

                                </address>
                            </div>
                            <div class="col-lg-6 text-right">
                                <p class="h3">Pay To</p>
                                <address>
                                    {{$details->user->first_name}} {{$details->user->last_name}}<br>
                                    {{$details->user->phone}}<br>
                                    {{$details->user->email}}
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive push">
                            <table class="table table-bordered table-hover">
                                <tr class=" ">
                                    <th class="text-center " style="width: 1%"></th>
                                    <th>Activity Requirements</th>
                                    <th class="text-right" style="width: 20%">Amount</th>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        <p class="font-w600 mb-1">Transportation</p>
                                    </td>

                                    <td class="text-right">{{number_2_format($details->transportation)}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <p class="font-w600 mb-1">Perdiem</p>
                                    </td>
                                    <td class="text-right">{{number_2_format($details->perdiem_total_amount)}}</td>
                                </tr>


                                <tr>
                                    <td class="text-center">3</td>
                                    <td>
                                        <p class="font-w600 mb-1">Others</p>
                                    </td>
                                    <td class="text-right">{{number_2_format($details->other_cost)}}</td>

                                    <div class="text-muted">{{$details->others_description}}</div>
                                </tr>
                                <tr>
                                    <td colspan="2" class="font-w600 text-right">Account No</td>


                                    <td class="text-right">   {{$details->user->phone}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="font-w600 text-right">Total Amount Requested</td>
                                    <td class="font-weight-bold text-right">{{number_2_format($details->total_amount)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="font-w600 text-right">Total Amount Paid</td>
                                    <td class="font-weight-bold text-right">{{number_2_format($details->amount_paid)}}</td>
                                </tr>

                                <tr>
                                    <td colspan="5" class="text-right">
                                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3" style="margin-left: 40%;">Verify Payment </button>

                                    </td>
                                </tr>
                                {{--  @if($payment->wf_done == false && $payment->user_id == access()->user()->id)
                                      <tr>
                                          <td colspan="5" class="text-right">
                                              <a href="#" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a>

                                          </td>
                                      </tr>
                                  @endif--}}
                            </table>
                        </div>
                        {{--                    <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>--}}
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largemodal1">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
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

    @endforeach







@endsection
