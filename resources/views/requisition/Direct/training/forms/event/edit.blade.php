

    <div class="row">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Edit Activity Schedule</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>

            <div class="card-body">
                {!! Form::open(['route' => ['training.storeTraining',$requisition]]) !!}
                {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required', 'hidden']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}
                            <input type="date" min="{{ now()->toDateString('Y-m-d') }}" class="form-control" name="from" value="{{$training_details->from}}">
                            {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('to',$training_details->to,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to']) !!}
                            {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('activity_location', __("Activity Location"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','required']) !!}
                            {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary" style="margin-left: 40%">Save changes</button>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

