@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                {{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
                <a href="{{route('requisition.show', $requisition_uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>
               @if($participant_total > 0)
                @if($requisition_count > 0)
                    {!! Form::open(['route'=> ['finance.store'],'method'=>'POST']) !!}
                    <button type="submit"  class="btn btn-outline-info" style="margin-left: 2%;"  >Submit For Approval</button>
                    {!! Form::close() !!}
                @else
                    <button type="button" data-toggle="modal" data-target="#exampleModal3" class="btn btn-outline-info" style="margin-left: 2%;"  >Verify Payment</button>

                       @endif
                @endif

            </div>

            <!-- Message Modal -->
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">Verify Amounts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['route'=> 'finance.store','method'=>'POST']) !!}
                            {!! Form::number('requisition_id', $requisition->id, ['class'=>'form-control','hidden'])  !!}
                            {!! Form::number('requested_amount', $requisition->amount, ['class'=>'form-control','hidden'])  !!}
                            {!! Form::number('region_id', $requisition->region_id, ['class'=>'form-control','hidden'])  !!}
                            {!! Form::text('payment_method', 'N/A', ['class'=>'form-control','hidden'])  !!}
                            {!! Form::text('account_no', 'N/A', ['class'=>'form-control','hidden'])  !!}
                            @if($program_activity->count() > 0)
                                <select name="pay_to" id="pay_to" class="form-control">
                                    <option value="0">Select What to Pay</option>
                                    <option value="1">Participants</option>
                                    <option value="2">Items</option>
                                    <option value="3">Both Participants and Items</option>
                                </select>
                                <br>
                                <input type="number" class="form-control" name="participant_total" id="participant_total" value="{{$participant_total}}" style="display: none">

                                <input type="number" class="form-control" name="vendor_total" id="vendor_total" value="{{$items_total}}" style="display: none">
                                <input type="number" class="form-control" name="both_total" id="both_total" value="{{$items_total + $participant_total}}" style="display: none">
                            @endif
                            @if($safari_advance->count() > 0)
                                <label for="recipient-name" class="form-control-label">Total Amount:</label>
                                <input type="number" class="form-control" name="total_amount">

                            @endif

                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Remarks:</label>
                                {!! Form::textarea('remarks',null,['class'=>'form-control', 'placeholder'=>'max 200 words']) !!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary" >Verify</button>
                        </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($safari_advance->count() > 0)
    @include('finance.payments.safariShow')
    @elseif($program_activity->count() > 0)
    @include('finance.payments.programActivityShow')
    @endif
@endsection

@push('after-scripts')

    <script>
        $(document).ready(function (){
            let $pay_to = $("select[name='pay_to']");

            $pay_to.change(function (event){
                if (this.value == '1'){
                    $("#participant_total").show();
                    $("#vendor_total").hide();
                    $("#both_total").hide();
                }
                if (this.value == '2'){
                    $("#participant_total").hide();
                    $("#both_total").hide();
                    $("#vendor_total").show();
                }
                if (this.value == '0') {
                    $("#participant_total").hide();
                    $("#vendor_total").hide();
                    $("#both_total").hide();
                }
                if (this.value == '3'){
                    $("#participant_total").hide();
                    $("#vendor_total").hide();
                    $("#both_total").show();

                }
            });
        });
    </script>
@endpush

