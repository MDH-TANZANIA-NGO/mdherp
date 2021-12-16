@if($requisition->training()->count() > 0)

{{--    <div class="row" >--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                {!! Form::date('from',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'from', 'disabled']) !!}--}}
{{--                {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                {!! Form::date('to',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to', 'disabled']) !!}--}}
{{--                {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}
{{--         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal"  id="scheddule">Edit Schedule </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="schedule" id="schedule">--}}
{{--        <!-- Large Modal -->--}}
{{--        <div id="largeModal" class="modal fade">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content ">--}}
{{--                    <div class="modal-header pd-x-20">--}}
{{--                        <h6 class="modal-title">Schedule Event</h6>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body pd-20">--}}
{{--                        {!! Form::open(['route' => ['training.storeTraining',$requisition]]) !!}--}}
{{--                        <div class="row">--}}
{{--                            {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required', 'hidden']) !!}--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                    {!! Form::date('from',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'from']) !!}--}}
{{--                                    {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                    {!! Form::date('to',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to']) !!}--}}
{{--                                    {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    {!! Form::label('destination', __("Destination"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                    {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','required']) !!}--}}
{{--                                    {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- modal-body -->--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- modal-dialog -->--}}
{{--            {!! Form::close() !!}--}}
{{--        </div><!-- modal -->--}}
{{--    </div>--}}



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

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('item_name', __("Item Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
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
@else
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#largeModal" style="margin-left: 45%; " id="scheddule">Schedule Event</button>


    <div class="schedule" id="schedule">
        <!-- Large Modal -->
        <div id="largeModal" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header pd-x-20">
                        <h6 class="modal-title">Schedule Event</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-20">
                        {!! Form::open(['route' => ['training.storeTraining',$requisition]]) !!}
                        <div class="row">
                            {!! Form::number('requisition_id', $requisition->id,['class' => 'form-control', 'required', 'hidden']) !!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('from', __("Start Date"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::date('from',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'from']) !!}
                                    {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('to', __("End Date"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::date('to',null,['class' => 'form-control', 'placeholder' => '','required', 'id'=>'to']) !!}
                                    {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('destination', __("Destination"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','required']) !!}
                                    {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div><!-- modal-dialog -->
            {!! Form::close() !!}
        </div><!-- modal -->
    </div>



@endif


<script>
    function myFunction() {
        var x = document.getElementById("mainContent");
        var y = document.getElementById("scheddule");
        var	from = $('#form').val();
        var	to = $('#to').val();
        //
        // if (from === '' || to === ''){
        //     alert('fields are empty')
        // }
        // else {
        //     x.style.display = "block";
        //     y.style.display = 'none';
        // }

        x.style.display = "block";
        y.style.display = 'none';

    }
    // jQuery, bind an event handler or use some other way to trigger ajax call.
    $('form').submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: '{{route('training.store',$requisition)}}',
            type: 'post',
            data: $('form').serialize(), // Remember that you need to have your csrf token included
            dataType: 'json',
            success: function( _response ){
                // Handle your response..
            },
            error: function( _response ){
                // Handle error
            }
        });
    });
</script>





