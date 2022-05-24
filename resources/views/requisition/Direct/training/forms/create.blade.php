<!-- Row -->

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Add Activity Costs</h3>

                <div class="tags" style="margin-left: 2%">


                    <div class="tag" >
                        Start date
                        <span class="tag-addon tag-success">{{$training_details->start_date}}</span>
                    </div>
                    <div class="tag">
                        End date
                        <span class="tag-addon tag-success">{{$training_details->end_date}}</span>
                    </div>
                    <div class="tag">
                       Activity Location
                        <span class="tag-addon tag-success">{{$training_details->district->name}}</span>
                    </div>
                    <div class="tag">
                        Change Event Schedule
                        <span class="tag-addon tag-primary" data-toggle="modal" data-target="#largeModal">Click Here</span>
                    </div>

                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>

            <div class="card-body">


                <div class="row">

                    <div class="col-md-12 col-xl-6">
                        <div class="card">
                            <div class="card-status card-status-left bg-red br-bl-7 br-tl-7"></div>
                            <div class="card-header">
                                <h3 class="card-title">Participant's Costs</h3>
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
                                            {!! Form::select('participant_uid',$gofficer, null, ['class' => 'form-control select2-show-search', 'required','placeholder'=>'Select Participant']) !!}
                                            {!! $errors->first('participant_uid', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('perdiem_rate', __("Perdiem Rate"),['class'=>'form-label','required_asterik']) !!}
                                            {!! Form::select('perdiem_rate_id',$grate, null,['class' => 'form-control select2-show-search', 'placeholder'=>'Select Perdiem Rate']) !!}
                                            {!! $errors->first('perdiem_rate_id', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('transportation', __("Transportation"),['class'=>'form-label','required_asterik']) !!}
                                            {!! Form::number('transportation',null,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
                                            {!! $errors->first('transportation', '<span class="badge badge-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('other_cost', __("Other Costs"),['class'=>'form-label','required_asterik']) !!}
                                            {!! Form::number('other_cost',null,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
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
                    <div class="col-md-12  col-xl-6">
                        <div class="card">
                            <div class="card-status bg-blue "></div>
                            <div class="card-header">
                                <h3 class="card-title">Item costs</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">

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

                </div>
                <!-- End Row-->
            </div>


        </div>
    </div>

    </div>


<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1">Change Event Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <div class="modal-body">
       {!! Form::open(['route' => ['training.updateSchedule',$training_details->uuid], 'method'=>'POST']) !!}

       {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required', 'hidden']) !!}
       <div class="row">
           <div class="col-md-4">
               <div class="form-group">
                   {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}
                   <input type="date" min="{{ now()->toDateString('Y-m-d') }}" class="form-control" name="from" value="{{$training_details->start_date}}">
                   {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
               </div>
           </div>
           <div class="col-md-4">
               <div class="form-group">
                   {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}
                   {!! Form::date('to',$training_details->end_date,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to']) !!}
                   {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
               </div>
           </div>
           <div class="col-md-4">
               <div class="form-group">
                   {!! Form::label('activity_location', __("Activity Location"),['class'=>'form-label','required_asterik']) !!}
                   {!! Form::select('district_id',$districts,$training_details->district_id,['class' => 'form-control select2-show-search','required','style'=>'width:100%']) !!}
                   {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
               </div>
           </div>
       </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
   </div>
        </div>
    </div>






@include('requisition.Direct.training.datatables.all')








