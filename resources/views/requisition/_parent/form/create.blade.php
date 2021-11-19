@extends('layouts.app')

@push('after-style')
    <style>
        .hidden {
            display: none;
        }
    </style>
@endpush

@section('content')

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="inner-all">
                            <ul class="list-unstyled">
                                <label>Requisition Type</label>
                                <li class="text-center">
                                    {!! Form::select('requisition_type',$requisition_types,null,['class' => 'form-control','placeholder' => 'select']) !!}
                                </li>
                                <br>
                                <label>Project</label>
                                <li class="text-center">
                                    {!! Form::select('project',$projects,null,['class' => 'form-control','placeholder' => 'select','disabled']) !!}
                                </li>
                                <br>
                                <label>Activity</label>
                                <li>
{{--                                    {!! Form::select('activity',[],null,['class' => 'form-control select2-show-search','placeholder' => 'select','disabled']) !!}--}}
                                    <select name="activity" class="form-control select2-show-search" disabled></select>
                                </li>
                                <br>
                                <li>
                                    <button type="button" class="btn btn-primary text-center btn-block" id="get_info">Get Info</button>
                                </li>
                             <br>
                            </ul>
                    </div>
                </div>
            </div>
{{--            <div class="card panel-theme rounded shadow">--}}
{{--                <div class="card-header">--}}
{{--                    <div class="float-left">--}}
{{--                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fe fe-map-pin mr-2"></i>Location</button>--}}
{{--                    </div>--}}
{{--                    <div class="card-options text-right">--}}
{{--                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong1"><i class="fe fe-paperclip mr-2"></i>Attachment</button>--}}
{{--                    </div>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}

{{--            </div>--}}
        </div>
        <div class="col-xl-9 col-lg-7 col-md-8">

            <div class="card">
                <div class="col-xs-12 col-sm-6 col-lg-12">
                    <div class="offer offer-success">
                        <div class="shape">
                            <div class="shape-text">

                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead">
                                Afya Kwanza
                            </h3>
                            <p class="mb-0">
                                2.3.5 To facilitate SI and TA in Data  all other activities must be set here so as user can understand the feeling.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Workflow</h5>
                                    </div>
                                    <p class="mb-1">Direct Workflow</p>
                                </div>


                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Sub Program Area</h5>
                                    </div>
                                    <p class="mb-1">HTS</p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Numeric Output</h5>
                                    </div>
                                    <p class="mb-1">30</p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Output unit</h5>
                                    </div>
                                    <p class="mb-1">Viral loads</p>
                                </div>


                            </div>
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item justify-content-between"><b>Budget </b><span class="badgetext badge badge-primary badge-pill" style="font-size: larger">$14,000,000</span></li>
                                <li class="list-group-item justify-content-between" ><b>Actual </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Commitment </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Reprogrammed </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Pipeline </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Available Budget </b><span class="badgetext badge badge-success badge-pill" style="font-size: larger">$14,000</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

    <!-- Row-->
{{--    <div class="row">--}}
{{--        <div class="col-md-12 col-lg-12">--}}
{{--            <div class="card">--}}

{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="expanel expanel-success">--}}
{{--                            <div class="expanel-heading clearfix">Panel title (with table inside)--}}
{{--                                <div class="float-right">--}}
{{--                                    <button class="btn btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapse03"--}}
{{--                                            aria-expanded="false" aria-controls="collapse03"><i class="fa fa-bars"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="expanel-body collapse" id="collapse03">--}}
{{--                                <table class="table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>#</th>--}}
{{--                                        <th>First Name</th>--}}
{{--                                        <th>Last Name</th>--}}
{{--                                        <th>Username</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row">1</th>--}}
{{--                                        <td>Mark</td>--}}
{{--                                        <td>Otto</td>--}}
{{--                                        <td>@mdo</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row">2</th>--}}
{{--                                        <td>Jacob</td>--}}
{{--                                        <td>Thornton</td>--}}
{{--                                        <td>@fat</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row">3</th>--}}
{{--                                        <td>Larry</td>--}}
{{--                                        <td>the Bird</td>--}}
{{--                                        <td>@twitter</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="table-responsive push">--}}
{{--                            <table class="table table-bordered table-hover">--}}
{{--                                <tr class=" ">--}}
{{--                                    <th class="text-center " style="width: 1%"></th>--}}
{{--                                    <th>Location</th>--}}
{{--                                    <th class="text-center" style="width: 10%">Output Unit</th>--}}
{{--                                    <th class="text-right" style="width: 10%">Numeric Output</th>--}}
{{--                                    <th class="text-right" style="width: 10%">Available Budget</th>--}}
{{--                                    <th class="text-right" style="width: 12%">Requested Amount</th>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="text-center"><span style="color: red"><i class="fa fa-trash-o"></i></span></td>--}}
{{--                                    <td>--}}
{{--                                        <p class="font-w600 mb-1">Ilala DC</p>--}}
{{--                                        <div class="text-muted">To do HTS and TDM</div>--}}
{{--                                    </td>--}}
{{--                                    <td class="text-center">Laptops</td>--}}
{{--                                    <td class="text-right">7</td>--}}
{{--                                    <td class="text-right">1000000</td>--}}
{{--                                    <td class="text-right">100000</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="text-center"><span style="color: red"><i class="fa fa-trash-o"></i></span></td>--}}
{{--                                    <td>--}}
{{--                                        <p class="font-w600 mb-1">Ilala DC</p>--}}
{{--                                        <div class="text-muted">To do HTS and TDM</div>--}}
{{--                                    </td>--}}
{{--                                    <td class="text-center">Laptops</td>--}}
{{--                                    <td class="text-right">7</td>--}}
{{--                                    <td class="text-right">1000000</td>--}}
{{--                                    <td class="text-right">100000</td>--}}
{{--                                </tr>--}}


{{--                                <tr>--}}
{{--                                    <td colspan="5" class="font-w600 text-right">Total Amount ($)</td>--}}
{{--                                    <td class="text-right">$50.00</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td colspan="5" class="font-weight-bold text-uppercase text-right">Total Amount (TZS)</td>--}}
{{--                                    <td class="font-weight-bold text-right">450.00</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td colspan="6" class="text-right">--}}
{{--                                        <button type="button" class="btn btn-success" onClick="javascript:window.print();"><i class="si si-folder"></i> Save</button>--}}
{{--                                        <button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-share-alt"></i> Submit</button>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                    <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End row-->
    </div>
    </div><!-- end app-content-->


{{--    forms models--}}

    <!--Add Location Modal-->
{{--    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLongTitle">Add Location</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                  <form>--}}
{{--<label>Council</label>--}}
{{--                      <select class="form-control" >--}}
{{--                          <optgroup label="Mountain Time Zone">--}}
{{--                              <option value="AZ">HTS</option>--}}
{{--                              <option value="CO">TA Data cleaning</option>--}}
{{--                              <option value="ID">DQI</option>--}}
{{--                              <option value="MT">Net Gain</option>--}}
{{--                              <option value="NM">TDM</option>--}}
{{--                          </optgroup>--}}

{{--                      </select>--}}
{{--                      <br>--}}
{{--                      <label>Amount</label>--}}
{{--                      <input type="number" class="form-control">--}}
{{--                      <br>--}}
{{--                      <label>Numeric Output</label>--}}
{{--                      <input type="number" class="form-control">--}}
{{--                      <br>--}}
{{--                      <label>Output unit</label>--}}
{{--                      <input type="text" disabled class="form-control" value="Participant">--}}
{{--                      <br>--}}
{{--                      <label>Description</label>--}}
{{--                      <textarea class="form-control"></textarea>--}}
{{--                  </form>--}}

{{--                          </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!--Add Location Modal-->
{{--    <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLongTitle">Add Attachment</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form>--}}

{{--                    </form>--}}

{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $requisition_type_select = $("select[name='requisition_type']");
            let $project_select = $("select[name='project']");
            let $activity_select = $("select[name='activity']");
            let $get_info_button = $("#get_info");

            $requisition_type_select.change(function (event){
                event.preventDefault();
                $project_select.attr('disabled', false);
            });
            $project_select.change(function (event){
                event.preventDefault();
                let $project_id = $(this).val();
                let $user_id = "{{ access()->id() }}";
                let $region_id = "{{ access()->user()->region_id }}";
                fetch_activities($user_id, $region_id, $project_id);
                $activity_select.attr('disabled', false);
            });

            function fetch_activities(user_id,region_id,project_id){
                $.get("{{ route('activity.json_filter') }}", { user_id: user_id,region_id: region_id, project_id: project_id},
                    function(data, status){
                    console.log(data)
                        if(data.length > 0){
                            $activity_select.find('option').remove();
                            $.each(data, function(key, result) {
                                let $option = "<option value='"+result.id+"'>"+result.title+"</option>";
                                $activity_select.append($option);
                            });
                        }else{

                        }
                    });
            }

            $activity_select.change(function (event){
                event.preventDefault();
                let $requisition_type_id = $requisition_type_select.val();
                let $project_id = $project_select.val();
                let $activity_id = $(this).val();
                let $region_id = "{{ access()->user()->region_id }}";
                let $fiscal_year = null;

                fetch_activity_details($requisition_type_id,$project_id,$activity_id,$region_id,$fiscal_year);
            });

        function fetch_activity_details(requisition_type_id,project_id,activity_id,region_id,fiscal_year){
            $.get("{{ route('requisition.get_json') }}", { requisition_type_id: requisition_type_id,project_id: project_id, activity_id: activity_id, region_id: region_id, fiscal_year: fiscal_year},
                function(data, status){
                    console.log(data)
                    if(data.length > 0){

                    }else{

                    }
                });
        }

            // if($requisition_type_select.val() && $project.val()){
            //     $get_info_button.removeAttr('disabled', false);
            // }else{
            //     $get_info_button.attr('disabled', true);
            // }

            // $get_info_button.click(function (event){
            //     event.preventDefault();
            //
            // });

            {{--function fetch_projects(region_id){--}}
            {{--    $.get("{{ route('project.by_region') }}", { region_id: region_id},--}}
            {{--        function(data, status){--}}
            {{--            if(data.length > 0){--}}

            {{--                $project_select.find('option').remove();--}}
            {{--                $.each(data, function(key, result) {--}}
            {{--                    $projects.push(result.id);--}}
            {{--                    let $option = "<option value='"+result.id+"'>"+result.title+"</option>";--}}
            {{--                    $project_select.append($option);--}}
            {{--                });--}}
            {{--                $project_select.attr('disabled',false);--}}
            {{--                $project_select.attr('required',true);--}}
            {{--                $sub_program_select.attr('disabled',false);--}}
            {{--                /*call sub program function*/--}}
            {{--                // fetch_sub_program()--}}
            {{--            }else{--}}
            {{--                $project_select.find('option').remove();--}}
            {{--                $project_select.attr('disabled',true);--}}
            {{--                $project_select.attr('required',false);--}}
            {{--                $sub_program_select.attr('disabled',true);--}}
            {{--            }--}}
            {{--        });--}}
            {{--}--}}


        });
    </script>
@endpush
