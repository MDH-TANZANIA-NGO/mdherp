@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Retirement Form</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                </div>
            </div>
            {!! Form::open(['route' => ['retirement.update',$retirement], 'enctype'=>'multipart/form-data']) !!}
            <div class="card-body">
                @foreach($retire_safaris AS $retire_safari)
                    <div class="row">

                        <div class="col-md-4" >
                            <div class="form-group">
                                <label class="form-label">Destination</label>
                                <div class="input-group">
                                    {!! Form::select('district_id',$district, $retire_safari->district_id, ['class' => 'form-control', 'hidden']) !!}
                                    {!! Form::select('district_id_show',$district, $retire_safari->district_id, ['class' => 'form-control select2-show-search', 'disabled']) !!}
                                    {!! Form:: text('safari_advance_id', $retire_safari->safari_id,['class'=>'form-control','hidden'])!!}


                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="form-label">Travel Date:</label>
                                {!! Form::date('from_show', $retire_safari->from, ['class' => 'form-control', 'disabled', 'id'=>'from']) !!}
                                {!! Form::date('from', $retire_safari->from, ['class' => 'form-control','hidden', 'required', 'id'=>'from']) !!}

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <label class="form-label">Return Date:</label>
                                {!! Form::date('to', $retire_safari->to, ['class' => 'form-control', 'required','id'=>'to']) !!}

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4" >

                            <div class="form-group">
                                <label class="form-label">Amount Requested & Approved</label>
                                <div class="input-group">
                                    {!! Form::text('amount_requested_show', $retire_safari->amount_requested, ['class' => 'form-control', 'disabled' ]) !!}
                                    {!! Form::text('amount_requested', $retire_safari->amount_requested, ['class' => 'form-control', 'hidden' ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" >

                            <div class="form-group">
                                <label class="form-label">Amount Advanced</label>
                                {{--                    {!! Form::text('amount_paid_show', $retire_safari->amount_paid, ['class' => 'form-control', 'disabled' ]) !!}--}}
                                <input type="text" id="a_paid" onblur="calculate('a_paid','a_spent','a_variance')" disabled name="amount_paid_show" class="form-control" value="{{$retire_safari->amount_paid}}">
                                {!! Form::text('amount_paid', $retire_safari->amount_paid, ['class' => 'form-control', 'hidden' ]) !!}
                            </div>
                        </div>

                        <div class="col-md-4" >

                            <div class="form-group">
                                <label class="form-label">Amount Received </label>
                                {!! Form::number('amount_received', $retire_safari->amount_paid, ['class' => 'form-control', 'placeholder'=>'Enter amount you received' ]) !!}
                                {{--                            <input type="number" name="amount_received" class="form-control" placeholder="Enter amount you received">--}}

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6" >

                            <div class="form-group">
                                <label class="form-label">Actual Amount Spent </label>
                                {{--                            {!! Form::number('amount_spent',$retire_safari->amount_received, ['class' => 'form-control', 'placeholder'=>'Enter amount you received' ]) !!}--}}
                                <input type="number" id="a_spent" onkeydown="calculate('a_paid','a_spent','a_variance')" name="amount_spent" class="form-control" required placeholder="Enter amount you spent">

                            </div>
                        </div>
                        <div class="col-md-6" >

                            <div class="form-group">
                                <label class="form-label">Variance Amount</label>
                                <input type="number" id="a_variance" onblur="calculate('a_paid','a_spent','a_variance')" name="amount_variance" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Background Information: <span class="form-label-small">56/100</span></label>
                            <textarea class="form-control" name="activity_report" rows="7" placeholder="Write activity report.." required></textarea>
                        </div>
                    </div>


                </div>
&nbsp;

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">What was Planned:</label>
                                <textarea rows="2" cols="50" class="form-control" name="" rows="7" placeholder="Write the plan.." required></textarea>
                            </div>
                        </div>
                    </div>

                    &nbsp;

                    <div class="row">
                        <div  class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Number of Participants:</label>
                            <input type="number" name="" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-10" >
                            <div class="form-group">
                                <label class="form-label">Objectives:</label>
                                <textarea rows="2" cols="50" class="form-control" name="" rows="7" placeholder="Write your objectives.." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">Methodology:</label>
                                <textarea rows="2" cols="50" class="form-control" name="" rows="7" placeholder="Write the methodology.." required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class ="row">
                    <div class="container lst">
                    <div class="input-group hdtuto control-group lst increment" >

                      {{--  <div class="col-md-4" >
                        <input type="text" name="title[]" class="form-control" placeholder="Enter Attachment name">
                        </div>--}}
                            <div class="col-md-4" >
                        <input type="file" name="attachments[]" class="form-control">
                            </div>
                        <div class="input-group-btn col-md-4">
                            <button class="btn btn-success att_button" type="button"><i class=""></i>Add attachment field</button>
                        </div>
                    </div>

                    <div class="clone hide">
                        <div class="hdtuto control-group lst input-group remuv" style="margin-top:10px">
                           {{-- <div class="col-md-4" >
                            <input type="text" name="title[]" class="form-control" placeholder="Enter Attachment name">
                            </div>--}}
                            <div class="col-md-4" >
                            <input type="file" name="attachments[]" class="form-control">
                            </div>

                            <div class="input-group-btn col-md-4" >
                               <button class="btn btn-danger att_button_rem" type="button"><i class=""></i>Remove attachment field</button>
                            </div>

                        </div>
                    </div>


                    </div>
                    </div>

&nbsp;

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit For Approval</button>
                        </div>

                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @push('after-scripts')
        <script>
            calculate = function (a_paid, a_spent, a_variance) {
                var amount_advanced = (document.getElementById(a_paid).value);
                var amount_spent = parseFloat(document.getElementById(a_spent).value).toFixed(2);
                var amount_variance = (amount_advanced) - (amount_spent);
                (document.getElementById(a_variance).value) = (amount_variance);
            }

            $(document).ready(function() {
                $(".att_button").click(function(){
                    var lsthmtl = $(".clone").html();
                    $(".increment").after(lsthmtl);

                });
                $("body").on("click",".att_button_rem",function(){
                    $(this).parents(".remuv").remove();
                });
            });

           /* $(document).ready(function() {
                var max_fields      = 6; //maximum input boxes allowed
                var wrapper         = $(".increment"); //Fields wrapper
                var add_button      = $(".btn-success"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="input-group-btn">'
                            +'<button class="btn btn-danger remove_field" type="button">'+
                            +'<i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>'+
                            +'</div>');
                        var lsthmtl = $(".clone").html();
                        $(".increment").after(lsthmtl);//add input box
                    }
                });

                $(wrapper).on("click",".btn-danger", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });*/

        </script>
    @endpush

@endsection
