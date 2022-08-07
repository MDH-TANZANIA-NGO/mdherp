<div class="row">
    <div class="col-md-12">
        <div class="card">
            {!! Form::open(['route' => ['training.payBulk']]) !!}
            <div class="card-header">

                <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Save</button>
                <a href="#" class="btn btn-outline-success" style="margin-left: 2%"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
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

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#payment_table").dataTable({
                pagingType: 'full_numbers',
            })

        })

        </script>
@endpush


