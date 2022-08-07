<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-outline-success" style="margin-left: 2%"><i class="fa fa-file-excel-o"></i> Export to Excel</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>
                            <th>Full name</th>
                            <th>Amount Requested</th>
                            <th>Amount Paid</th>
                            <th>Phone</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($training_costs as $key=>$training_cost)

                                <tr>
                                    <td>       @if($training_cost->amount_paid == 0 and $training_cost->amount_paid != null)
                                            <s> {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}</s>
                                        @else
                                            @if($training_cost->is_substitute == true)
                                                <i class="fa fa-exchange text-info"></i>  {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}
                                            @else
                                                {{$training_cost->user->first_name}} {{$training_cost->user->last_name}}
                                            @endif
                                        @endif</td>
                                  <td>{{number_2_format($training_cost->total_amount)}}</td>
                                    <td>{{number_2_format($training_cost->amount_paid)}}</td>
                                    <td>{{$training_cost->user->phone}}</td>
                                    <td>{{$training_cost->remarks}}</td>
                                </tr>



                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



