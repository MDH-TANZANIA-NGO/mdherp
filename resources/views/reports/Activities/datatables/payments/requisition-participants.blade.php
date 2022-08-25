<div class="row">
    <div class="col-md-12">
        <div class="card">
            {!! Form::open(['route' => ['training.payBulk']]) !!}
            <div class="card-header">
                <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Save</button>
                <a href="#" class="btn btn-outline-success" style="margin-left: 2%"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
               @permission('finance_activity')
                @if($activity_report != null)
                <a href="#" class="btn btn-primary" data-toggle="modal" style="margin-left: 2%" data-target="#largemodal">Send for approval</a>
                @endif
                    @endpermission
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="payment_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                                    <tr>
                                        <th>Full name</th>
                                        <th>Amount Requested</th>
                                        <th>Amount Paid</th>
                                        <th>Phone</th>
                                        <th>Remarks</th>
                                        <th>Swap with</th>
                                    </tr>
                                   </thead>
                                    <tbody>
<tr >

                                    @foreach($training_costs as $key=>$training_cost)

                                         <td>
                                             @if($training_cost->amount_paid == 0 and $training_cost->amount_paid != null)
                                             <s> {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}</s>
                                             @else
                                                 @if($training_cost->is_substitute == true)
                                                     <i class="fa fa-exchange text-info"></i>  {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}
                                                 @else
                                                 {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}
                                                     @endif
                                                 @endif
                                         </td>
{{--                                            <td>{{number_2_format($training_cost->perdiem_total_amount)}}</td>--}}
{{--                                            <td>{{number_2_format($training_cost->transportation)}}</td>--}}
{{--                                            <td>{{number_2_format($training_cost->other_cost)}}</td>--}}
                                            <td>{{number_2_format($training_cost->total_amount)}}</td>
                                         <td>
                                            <input type="text" name="uuid[]" value="{{$training_cost->uuid}}" hidden>
                                             <input type="text" name="current_participant[]" value="{{$training_cost->participant_uid}}" hidden>
                                             @if($training_cost->amount_paid == null)
                                                 <input type="text" class="form-control" name="amount_paid[]" value="{{$training_cost->total_amount}}">
                                             @else
                                                 <input type="number" class="form-control" name="amount_paid[]" value="{{$training_cost->amount_paid}}">
                                             @endif
                                         </td>
                                         <td>
                                             @if($training_cost->account_no == null)
                                             <input type="text" value="{{$training_cost->user->phone}}" class="form-control" name="account_no[]">
                                             @else
                                                 <input type="text" value="{{$training_cost->account_no}}" class="form-control" name="account_no[]">
                                                 @endif
                                         </td>



                                         <td>
                                             @if($training_cost->remarks == null)
                                             <input type="text" class="form-control" name="remarks[]" value="Paid as requested">
                                             @else
                                                 <input type="text" class="form-control" name="remarks[]" value="{{$training_cost->remarks}}">
                                                 @endif
                                         </td>
                                            <td>
                                                {!! Form::select('substitute_participant[]',$gofficer, null, ['class' => 'form-control select2-show-search','placeholder'=>'Select Participant']) !!}</td>
                                        </tr>
                                        {!! Form::close() !!}
                                    @endforeach
                                    </tbody>
                    </table>


        </div>
    </div>
</div>


</div>
</div>

@if($activity_report != null)
<!-- Modal -->
<div class="modal fade" id="largemodal" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largemodal1">Confirm and send for approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tbody><tr class=" ">
                            <th class="text-center " style="width: 1%"></th>
                            <th>Paid Item</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-right" style="width: 1%">Amount</th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="font-w600 mb-1">Activity Participants</p>
                            </td>
                            <td class="text-center">{{$count_to_be_paid}}</td>
                            <td class="text-right">{{number_2_format($sum_to_be_paid)}}</td>
                        </tr>


                        <tr>
                            <td colspan="3" class="font-weight-bold text-uppercase text-right">Grand Total</td>
                            <td class="font-weight-bold text-right">{{number_2_format($sum_to_be_paid)}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td colspan="5" class="text-right">--}}
{{--                                <button type="button" class="btn btn-primary" onclick="javascript:window.print();"><i class="si si-wallet"></i> Pay Invoice</button>--}}
{{--                                <button type="button" class="btn btn-secondary" onclick="javascript:window.print();"><i class="si si-paper-plane"></i> Send Invoice</button>--}}
{{--                                <button type="button" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        </tbody></table>
                    {!! Form::open(['route' => ['finance.store_activity_payment']]) !!}
                    <input type="number" name="requisition_id" value="{{$requisition->id}}" hidden>
                    <input type="number" name="region_id" value="{{access()->user()->region_id}}" hidden>
                    <input type="text" name="remarks" value="Activity participants paid" hidden>
                    <input type="number" name="requested_amount" value="{{$requisition->amount}}" hidden>
                    <input type="number" name="total_amount" value="{{$sum_to_be_paid}}" hidden>
<input type="number" name="program_activity_report_id" value="" hidden>
                    <input type="number" name="activity_report_id" value="{{$activity_report->id}}" hidden>
                    <input type="number" name="program_activity_id" value="{{$program_activity->id}}" hidden>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send for approval</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endif
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#payment_table").dataTable({
                pagingType: 'full_numbers',
            })

        })

        </script>
@endpush


