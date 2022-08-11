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
                <div class="row pt-4">
                    <div class="col-lg-6 ">
                        <p class="h3">Safari Advanced Details</p>
                        <address>
                           {{-- Destination: {{$safari_advance->travellingCost->district->name}}<br>
                            {{--Departure: {{date('d-M-Y', strtotime($safari_advance->safariDetails->from))}}<br>
                            Return: {{date('d-M-Y', strtotime($safari_advance->safariDetails->to))}}<br>--}}
                        </address>
                    </div>
                    <div class="col-lg-6 text-right">
                        <p class="h3">Paid To</p>
                        <address>
{{--                            {{$safari_advance->user->full_name_formatted}}<br>--}}
                           {{$safariDetails->account_no}}<br>
                            {{--{{$safari_advance->user->email}}--}}
                        </address>
                    </div>
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr class=" ">
                            <th class="text-center " style="width: 1%"></th>
                            <th>Travel Requirements</th>
                            <th class="text-right" style="width: 20%">Attachments</th>
                            <th class="text-right" style="width: 20%">Amount</th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="font-w600 mb-1">Accommodation</p>
                            </td>
                            <td class="text-right"><input type="file" accept="application/pdf" name="accomodation_attachments" class="form-control"></td>
                            <td><input type="text" id="accomodation" name="accomodation" class="form-control" value="{{number_2_format($safariDetails->accommodation)}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <p class="font-w600 mb-1">Meals and Incidentals</p>
                            </td>
                            <td class="text-right"></td>
                            <td><input type="text" id="perdiem_total_amount" name="perdiem_total_amount" class="form-control" value="{{number_2_format($safariDetails->perdiem_total_amount)}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>
                                <p class="font-w600 mb-1">Ticket Fair</p>
                            </td>
                            <td class="text-right"><input type="file" accept="application/pdf" name="ticket_attachments" class="form-control"></td>
                            <td><input type="text" id="ticket_fair" name="ticket_fair" class="form-control" value="{{number_2_format($safariDetails->ticket_fair)}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>
                                <p class="font-w600 mb-1">Ontransit Allowance</p>
                            </td>
                            <td class="text-right"></td>
                            <td><input type="text" id="ontransit" name="ontransit" class="form-control" value="{{number_2_format($safariDetails->ontransit)}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>
                                <p class="font-w600 mb-1">Ground Transport</p>
                            </td>
                            <td class="text-right"><input type="file" accept="application/pdf" name="transportation_attachments" class="form-control"></td>
                            <td><input type="text" id="transportation" name="transportation" class="form-control" value="{{number_2_format($safariDetails->transportation)}}"></td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>
                                <p class="font-w600 mb-1">Other Cost</p>
                            </td>
                            <td class="text-right"><input type="file" accept="application/pdf" name="othercost_attachments" class="form-control"></td>
                            <td><input type="text" id="other_cost" name="other_cost" class="form-control" value="{{number_2_format($safariDetails->other_cost)}}"></td>

                            <div class="text-muted"></div>
                        </tr>
                       {{-- <tr>
                            <td colspan="2" class="font-w600 text-right">Account No</td>


                            <td class="text-right">{{$safariDetails->account_no}}</td>
                        </tr>--}}
                        {{--<tr>
                            <td></td>
                            <td colspan="2" class="font-w600 text-right">Total Amount Requested</td>
--}}{{--                            <td class="font-weight-bold text-right">{{number_2_format($safariDetails->total_amount)}}</td>--}}{{--
                            <td class="font-weight-bold text-right">{{number_2_format($safariDetails->requested_amount)}}</td>
                        </tr>--}}
                        <tr>
                            <td></td>
                            <td colspan="2" class="font-w600 text-right">Total Amount</td>
                            <td class="font-weight-bold text-right">
                                <input type="text" id="total_amount" class="form-control" disabled>
                                <input type="text" id="total_amount_hidden" hidden name="total_amount" class="form-control" value="">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="font-w600 text-right">Total Amount Paid</td>
                            <td class="font-weight-bold text-right">{{number_2_format($safariDetails->disbursed_amount)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="font-w600 text-right">Balance</td>
                            <td class="font-weight-bold text-right"><span id="calculation"></span></td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td colspan="2" class="font-w600 text-right">Total Amount Due to the Organization</td>--}}
{{--                            <td class="font-weight-bold text-right">{{number_2_format($safariDetails->total_amount)}}</td>--}}
{{--                        </tr>--}}
                    </table>
                </div>

                <hr>
                  {{--  <div class ="row">
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
                <hr>--}}

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Activity Report <span class="form-label-small">56/100</span></label>
                            <textarea class="content" name="activity_report" rows="2" placeholder="Write activity report.." required></textarea>
                        </div>
                    </div>


                </div>


{{--
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
--}}

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
            // calculate = function (perdiem_total_amount, accomodation, ticket_fair,ontransit,transportation,other_cost) {
            //     var perdiem_total_amount1 = (document.getElementById(perdiem_total_amount).value).toFixed(2);
            //     var accomodation1 = parseFloat(document.getElementById(accomodation).value).toFixed(2);
            //     var ticket_fair1 = parseFloat(document.getElementById(ticket_fair).value).toFixed(2);
            //     var ontransit1 = parseFloat(document.getElementById(ontransit).value).toFixed(2);
            //     var transportation1 = parseFloat(document.getElementById(transportation).value).toFixed(2);
            //     var other_cost1 = parseFloat(document.getElementById(other_cost).value).toFixed(2);
            //
            //     var total_amount1 = perdiem_total_amount1 + accomodation1 + ticket_fair1 + ontransit1 + transportation1 + other_cost1;
            //     (document.getElementById(total_amount).value) = (total_amount1);
            //
            // }

            $(document).ready(function (){

                let $perdiem_total_amount = $("#perdiem_total_amount");
                let $accomodation = $("#accomodation");
                let $ticket_fair = $("#ticket_fair");
                let $ontransit = $("#ontransit");
                let $transportation = $("#transportation");
                let $other_cost = $("#other_cost");
                let $total_amount = $("#total_amount");
                let $total_amount_hidden = $("#total_amount_hidden");
                let $calculation = $("#calculation");

                sum();

                $perdiem_total_amount.keyup(function (event){
                    event.preventDefault();
                    sum()
                });

                $accomodation.keyup(function (event){
                    event.preventDefault();
                    sum()
                });

                $ticket_fair.keyup(function (event){
                    event.preventDefault();
                    sum()
                });

                $ontransit.keyup(function (event){
                    event.preventDefault();
                    sum()
                });

                $transportation.keyup(function (event){
                    event.preventDefault();
                    sum()
                });

                $other_cost.keyup(function (event){
                    event.preventDefault()
                    sum()
                });

                function sum(){
                    let $sum = (parseInt($perdiem_total_amount.val().replace(/\,/g,'')) +
                        parseInt($accomodation.val().replace(/\,/g,'')) +
                        parseInt($ticket_fair.val().replace(/\,/g,'')) +
                        parseInt($ontransit.val().replace(/\,/g,'')) +
                        parseInt($transportation.val().replace(/\,/g,'')) +
                        parseInt($other_cost.val().replace(/\,/g,''))).toFixed(2)
                    $total_amount.val($sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $total_amount_hidden.val($sum);
                    let $paid = "{{ $safariDetails->disbursed_amount }}";
                    let $substraction =  $paid - $sum;
                    if($paid > $sum){
                        $calculation.removeClass("text-success");
                        $calculation.addClass("text-danger");
                    }else{
                        $calculation.removeClass("text-danger");
                        $calculation.addClass("text-success");
                    }
                    $calculation.html($substraction);

                }
            });





        </script>


    @endpush

@endsection
