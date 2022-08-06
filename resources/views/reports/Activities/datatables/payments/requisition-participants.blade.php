<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Payments</h3>
                {!! Form::open(['route' => ['training.updateBulk']]) !!}
                <div class="card-options ">
                    <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Save</button>
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
{{--                                        <th>Perdiem</th>--}}
{{--                                        <th>Transport</th>--}}
{{--                                        <th>Others</th>--}}
                                        <th>Amount Requested</th>
                                        <th>Amount Paid</th>
                                        <th>Phone</th>
                                        <th>Remarks</th>
                                        <th>Swap with</th>
                                    </tr>
                                   </thead>
                                    <tbody>
<tr>
                                    @foreach($training_costs as $key=>$training_cost)
                                         <td>{{$training_cost->user->first_name}} {{$training_cost->user->last_name}}</td>
{{--                                            <td>{{number_2_format($training_cost->perdiem_total_amount)}}</td>--}}
{{--                                            <td>{{number_2_format($training_cost->transportation)}}</td>--}}
{{--                                            <td>{{number_2_format($training_cost->other_cost)}}</td>--}}
                                            <td>{{number_2_format($training_cost->total_amount)}}</td>
                                         <td>

                                             @if($training_cost->amount_paid == null)
                                                 <input type="text" class="form-control" name="amount_paid[]" value="{{number_2_format($training_cost->total_amount)}}">
                                             @else
                                                 <input type="number" class="form-control" name="amount_paid[]" value="{{$training_cost->amount_paid}}">
                                             @endif
                                         </td>
                                         <td><input type="text" value="{{$training_cost->user->phone}}" class="form-control"></td>


                                         <td>             <input type="text" class="form-control" name="remarks[]" value="Paid as requested">
                                         </td>
                                            <td>
                                                {!! Form::select('participant_uid[]',$gofficer, null, ['class' => 'form-control select2-show-search', 'required','placeholder'=>'Select Participant']) !!}</td>
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


