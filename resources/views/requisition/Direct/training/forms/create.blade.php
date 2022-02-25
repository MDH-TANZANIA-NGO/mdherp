<!-- Row -->
<div class="row">

    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Add Training Participants</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>

            <div class="card-body">
                {!! Form::open(['route' => ['training.store',$requisition]]) !!}

                <div class="row">
                    {{--                                            {!! Form::number('from',$training->from,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'from']) !!}--}}
                    @foreach($training AS $training)
                        <input type="date" name="from" value="{{$training->from}}" hidden>
                        <input type="date" name="to" value="{{$training->to}}" hidden>
                        <input type="number" name="requisition_training_id" value="{{$training->id}}" hidden>
                    @endforeach
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('participant', __("Participant Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('participant_uid',$gofficer, null, ['class' => 'form-control select2-show-search', 'required']) !!}
                            {!! $errors->first('participant_uid', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('perdiem_rate', __("Perdiem Rate"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('perdiem_rate_id',$grate, null,['class' => 'form-control select2-show-search', 'required']) !!}
                            {!! $errors->first('perdiem_rate_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('transportation', __("Transportation"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::number('transportation',null,['class' => 'form-control', 'placeholder' => 'ie. 100,000','required']) !!}
                            {!! $errors->first('transportation', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('other_cost', __("Other Costs"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::number('other_cost',null,['class' => 'form-control', 'placeholder' => 'ie. 100,000','required']) !!}
                            {!! $errors->first('other_cost', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('others_description', __("Other Costs Description"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('others_description',null,['class' => 'form-control', 'placeholder' => '']) !!}
                            {!! $errors->first('other_cost', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>




                    <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Add Participant</button>

                </div>
                {!! Form::close() !!}
            </div>


        </div>


    </div>
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Add Training Items</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            {!! Form::open(['route' => ['training.storeTrainingItems',$requisition]]) !!}
            <div class="card-body">
                <div class="row">
                    {{--                    @foreach($training AS $training)--}}
                    {{--                        <input type="date" name="from" value="{{$training->from}}" hidden>--}}
                    {{--                        <input type="date" name="to" value="{{$training->to}}" hidden>--}}
                    {{--                        <input type="number" name="requisition_training_id" value="{{$training->id}}" hidden>--}}
                    {{--                    @endforeach--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::number('requisition_training_id', $training->id, ['class' => 'form-control', 'required', 'hidden']) !!}
                            {!! Form::label('item_name', __("Item Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('no_days', __("Days"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('no_days', 1, ['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('no_days', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('unit', __("Unit"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::number('unit', null, ['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('unit', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{--                        {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required' ,'hidden']) !!}--}}
                        <div class="form-group">
                            {!! Form::label('unit_price', __("Unit Price"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::number('unit_price', null,['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('unit_price', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>





                    <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Add Item</button>

                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</div>
<!--End  Row -->
</div>


@include('requisition.Direct.training.datatables.all')








