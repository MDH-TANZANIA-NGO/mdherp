{!! Form::open(['route' => ['training.store',$requisition], 'method' => 'POST']) !!}
<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Add Training Details</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">



            <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" >
                        <thead  class="bg-info text-white">
                        <tr >
                            <th class="text-white">Participants</th>
                            <th class="text-white">Days</th>
                            <th class="text-white">Destination</th>
                            <th class="text-white">Perdiem Rate</th>
                            <th class="text-white">Transport</th>
                            <th class="text-white">Others</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>	{!! Form::select('participant_uid',$gofficer, null, ['class' => 'form-control select2-show-search', 'required']) !!}</td>
                            <td><input type="number" class="form-control" name="no_days" placeholder="No days" required = "required"></td>
                            <td>{!! Form::select('district_id',$districts, null, ['class' => 'form-control select2-show-search', 'required']) !!}</td>
                            <td>{!! Form::select('perdiem_rate_id',$grate, null,['class' => 'form-control select2-show-search', 'required']) !!}</td>
                            <td><input type="number" class="form-control" name="transportation" placeholder="100,000" required = "required"></td>
                            <td><input type="number" class="form-control" name="other_cost" placeholder="100,000" required = "required"></td>
                            <td><button type="submit" class="btn btn-outline-info" >Add</button> </td>
                        </tr>
                        <tr>
{{--                            <input type="number" value="{{$requisition->id}}" name="requisition_id" >--}}
                            <lable><strong>Description</strong></lable><br>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}<br>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
<!--End  Row -->

{!! Form::close() !!}
