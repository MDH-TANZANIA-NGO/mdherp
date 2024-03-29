<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => ['travelling.store',$requisition],'class'=>'card']) !!}

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('traveller_name', __("Traveller Name"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('traveller_uid',$users, null, ['class' => 'form-control select2-show-search','placeholder'=>'Select Traveler', 'required']) !!}
                        {!! $errors->first('traveller_uid', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
{{--                <div class="col-sm-6 col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        {!! Form::label('destination', __("Destination"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                        {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','placeholder'=>'Select District','required']) !!}--}}
{{--                        {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('from', __("From Date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('from',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('to', __("To Date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('to',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Add Traveller</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

{{--{!! Form::open(['route' => ['travelling.store',$requisition], 'method' => 'POST']) !!}--}}
{{--<!-- Row -->--}}
{{--<div class="row">--}}
{{--    <div class="col-md-12 col-lg-12">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                --}}{{--                <h3 class="card-title">TRAINING  FORM</h3>--}}
{{--                <div class="card-options ">--}}
{{--                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
{{--                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table card-table table-vcenter text-nowrap" >--}}
{{--                        <thead  class="bg-info text-white">--}}
{{--                        <tr >--}}
{{--                            <th class="text-white">Travellor</th>--}}
{{--                            <th class="text-white">Days</th>--}}
{{--                            <th class="text-white">Destination</th>--}}
{{--                            <th class="text-white">Perdiem Rate</th>--}}
{{--                            <th class="text-white">Accommodation</th>--}}
{{--                            <th class="text-white">Transport</th>--}}
{{--                            <th class="text-white">Others</th>--}}
{{--                            <th class="text-white">Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>	{!! Form::select('traveller_uid',$users, null, ['class' => 'form-control select2-show-search', 'required']) !!}</td>--}}
{{--                            <td><input type="number" class="form-control" name="no_days" placeholder="No days" required = "required"></td>--}}
{{--                            <td> {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','required']) !!}</td>--}}
{{--                            <td>{!! Form::select('perdiem_rate_id',$mdh_rates, null,['class' => 'form-control select2-show-search', 'required']) !!}</td>--}}
{{--                            <td><input type="number" class="form-control" name="accommodation" placeholder="100,000" required = "required"></td>--}}
{{--                            <td><input type="number" class="form-control" name="transportation" placeholder="100,000" required = "required"></td>--}}
{{--                            <td><input type="number" class="form-control" name="other_cost" placeholder="100,000" required = "required"></td>--}}
{{--                            <td><button type="submit" class="btn btn-outline-info" >Add</button> </td>--}}
{{--                        </tr>--}}




{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!--End  Row -->--}}

{{--{!! Form::close() !!}--}}


