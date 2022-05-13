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



                <hr>
                    <div class ="row">
                        <div class="container lst">
                            <div class="input-group hdtuto control-group lst" >

                                <div class="col-md-3 col-lg-3 col-xl-3" >
                                    <input type="file" accept="application/pdf" name="attachments[]" class="form-control">
                                </div>

                                <div class="col-md-3 col-lg-3 col-xl-3" >
                                <input type="number" id="" name="amount_attachment[]" placeholder="Total Amount of the receipts" class="form-control">
                                </div>

                                <div class="col-md-3 col-lg-3 col-xl-3" >
                                    {!! Form::select('attachment_type[]', $attachment_type, null, ['class' =>'form-control select2-show-search ', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                </div>

                                <div class="input-group-btn col-md-3 col-lg-3 col-xl-3">
                                    <button class="btn btn-success att_button" type="button"><i class=""></i>Add attachment field</button>
                                </div>
                            </div>

                            <div id="increment"></div>

                        </div>
                    </div>
                <hr>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Background Information: <span class="form-label-small">56/100</span></label>
                            <textarea class="content" name="activity_report" rows="2" placeholder="Write activity report.." required></textarea>
                        </div>
                    </div>


                </div>


                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">What was Planned:</label>
                                <textarea rows="2" cols="50" class="content" name="planned_report" placeholder="Write the plan.." required></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div  class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Number of Participants:</label>
                            <input type="number" name="no_participants" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-10" >
                            <div class="form-group">
                                <label class="form-label">Objectives:</label>
                                <textarea rows="2" cols="50" class="content2" name="objective_report" placeholder="Write your objectives.." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">Methodology:</label>
                                <textarea rows="2" cols="50" class="form-control content" name="methodology_report" placeholder="Write the methodology..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">Achievements:</label>
                                <textarea rows="2" cols="50" class="content" name="achievement_report" placeholder="Write the Achievements..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">Challenges:</label>
                                <textarea rows="2" cols="50" class="form-control content" name="challenge_report" placeholder="Write the Challenges:..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="form-label">Recommendations/Action plans :</label>
                                <textarea class="content" name="action_report" placeholder="Write the Recommendations/Action plans..." required></textarea>
                            </div>
                        </div>
                    </div>

                    {{--<div class ="row">
                        <div class="container lst">
                            <div class="input-group hdtuto control-group lst" >

                      --}}{{--  <div class="col-md-4" >
                        <input type="text" name="title[]" class="form-control" placeholder="Enter Attachment name">
                        </div>--}}{{--
                                <div class="col-md-4" >
                                    <input type="file" accept="application/pdf" name="attachments[]" class="form-control">
                                </div>
                                <div class="input-group-btn col-md-4">
                                    <button class="btn btn-success att_button" type="button"><i class=""></i>Add attachment field</button>
                                </div>
                            </div>

                            <div id="increment"></div>

                        </div>
                    </div>--}}

                    <hr>
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
                var amount_variance = amount_advanced - amount_spent;
                (document.getElementById(a_variance).value) = (amount_variance);

            }

            $(document).ready(function() {
                $(".att_button").click(function(event){
                    event.preventDefault();
                    // var lsthmtl = $(".clone").html();
                    // $(".increment").after(lsthmtl);
                    let $increment = $("#increment");

                    $increment.prepend('' +
                            '<div class="hdtuto control-group lst input-group remuv" style="margin-top:10px">'+
                                '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                                    '<input type="file" accept="application/pdf" name="attachments[]" class="form-control">'+
                                '</div>'+

                        '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                        '<input type="number" id="" name="amount_attachment[]" placeholder="Total Amount of the receipts"  class="form-control">'+
                        '</div>'+

                        '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                        '{!! Form::select("attachment_type[]", $attachment_type, null, ["class" =>"form-control select2-show-search", "placeholder" => __("label.select") , "aria-describedby" => "", "required"]) !!}'+
                        '</div>'+

                                '<div class="input-group-btn col-md-3 col-lg-3 col-xl-3" >'+
                                    '<button class="btn btn-danger att_button_rem" type="button"><i class=""></i>Remove attachment field</button>'+
                                '</div>'+
                            '</div>')

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
