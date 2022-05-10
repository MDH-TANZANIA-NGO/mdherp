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
                        {!! Form::open(['route' => 'requisition.store', 'method'=>'POST']) !!}
                            <ul class="list-unstyled">
                                <label>Requisition Type</label>
                                <li class="text-center">
                                    {!! Form::select('requisition_type',$requisition_types,null,['class' => 'form-control','placeholder' => 'select']) !!}
                                </li>
                                <br>
                                <div class="form-group" style="display: {{ access()->user()->region_id == 1 ? 'block' : 'none' }}" >
                                    <label>Region</label>
                                    <li>
                                        {!! Form::select('region',$regions,null,['class' => 'form-control','placeholder' => 'select','disabled']) !!}
                                    </li>
                                </div>
                                <br>
                                <label>Project</label>
                                <li class="text-center">
                                    {!! Form::select('project',$projects,null,['class' => 'form-control','placeholder' => 'select','disabled']) !!}
                                </li>
                                <br>
                                <label>Activity</label>
                                <li>
                                    {!! Form::select('activity',[],null,['class' => 'form-control select2-show-search','placeholder' => 'select','disabled']) !!}
{{--                                    <select name="activity" class="form-control select2-show-search" disabled></select>--}}
                                </li>
                                <br>
                               <div class="typee" id="typoo" style="display: none">
                                   <label>Requisition Type Category</label>
                                   <li>
                                       {!! Form::select('requisition_type_category',$requisition_type_category,null,['class' => 'form-control','placeholder' => 'select']) !!}
                                   </li>
                               </div>
                                <br>
                                <li>
                                    {!! Form::hidden('region_id', access()->user()->region_id) !!}
                                    {!! Form::hidden('budget_id', null) !!}
                                    <button type="submit" class="btn btn-primary text-center btn-block hidden" id="get_info">initiate</button>
                                </li>
                             <br>
                            </ul>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

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
                            <h3 class="lead" id="project_title"></h3>
                            <p class="mb-0" id="activity_title"></p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Requisition Type</h5>
                                    </div>
                                    <p class="mb-1" id="requisition"></p>
                                </div>


                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Sub Program Area</h5>
                                    </div>
                                    <p class="mb-1" id="sub_program"></p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Numeric Output</h5>
                                    </div>
                                    <p class="mb-1" id="numeric_output"></p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Output unit</h5>
                                    </div>
                                    <p class="mb-1" id="output_unit"></p>
                                </div>


                            </div>
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item justify-content-between">
                                    <b>Budget </b><span class="badgetext badge badge-primary badge-pill" id="budget" style="font-size: larger"></span>
                                </li>

                                <li class="list-group-item justify-content-between">
                                    <b>Reprogrammed Funds</b><span class="badgetext badge badge-default badge-pill" id="reprogrammed" style="font-size: larger"></span>
                                </li>

                                <li class="list-group-item justify-content-between" >
                                    <b>Actual Expenditure</b><span class="badgetext badge badge-default badge-pill" id="actual" style="font-size: larger"></span>
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Commitment </b><span class="badgetext badge badge-default badge-pill" id="commitment" style="font-size: larger"></span>
                                </li>

                                <li class="list-group-item justify-content-between">
                                    <b>Pipeline </b><span class="badgetext badge badge-default badge-pill" id="pipeline" style="font-size: larger"></span>
                                </li>
                                <li class="list-group-item justify-content-between">
                                    <b>Available Fund </b><span class="badgetext badge badge-success badge-pill" id="available" style="font-size: larger"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $requisition_type_select = $("select[name='requisition_type']");
            let $requisition_type_category_select = $("select[name='requisition_type_category']");
            let $project_select = $("select[name='project']");
            let $activity_select = $("select[name='activity']");
            let $budget_id_input = $("input[name='budget_id']");
            let $get_info_button = $("#get_info");

            let $project_title = $("#project_title");
            let $activity_title = $("#activity_title");
            let $requisition = $("#requisition");
            let $sub_program = $("#sub_program");
            let $numeric_output = $("#numeric_output");
            let $output_unit = $("#output_unit");
            let $budget = $("#budget");
            let $actual = $("#actual");
            let $commitment = $("#commitment");
            let $reprogrammed = $("#reprogrammed");
            let $pipeline = $("#pipeline");
            let $available = $("#available");
            let $region_select = $("select[name='region']");

            $requisition_type_select.change(function (event){
                event.preventDefault();
                // $project_select.attr('disabled', false);
                region_checker();
            });
            $requisition_type_select.change(function (event){
                if (this.value == '2'){
                    $("#typoo").show();
                }
                else {
                    $("#typoo").hide();
                }
            });

            $project_select.change(function (event){
                event.preventDefault();
                let $project_id = $(this).val();
                let $user_id = "{{ access()->id() }}";
                let $region_id = "{{ access()->user()->region_id }}";
                if($region_id == 1){
                    $region_id = $region_select.val();
                }
                fetch_activities($user_id, $region_id, $project_id);
                $activity_select.attr('disabled', false);
            });

            $region_select.change(function (event){
                let $region_id = $(this).val();
                $project_select.find('option').not(':first').remove();
                $project_select.attr('disabled', false);
                let $url = base_url+'/projects/'+$region_id+'/region';
                $.get($url, function(data, status){
                        if(data.length > 0){
                            $.each(data, function(key, result) {
                                let $option = "<option value='"+result.id+"'>"/*+result.code+""*/+result.title+"</option>";
                                $project_select.append($option);
                            });
                        }else{
                            $project_select.find('option').not(':first').remove();
                        }
                    });
            });

            function region_checker()
            {
                let $access_user_region_id = "{{ access()->user()->region_id }}";
                if($access_user_region_id == 1){
                    $region_select.removeAttr('disabled',false);
                }else{
                    $project_select.attr('disabled', false);
                }
            }

            function fetch_activities(user_id,region_id,project_id){
                $.get("{{ route('activity.json_filter') }}", { user_id: user_id,region_id: region_id, project_id: project_id},
                    function(data, status){
                        if(data.length > 0){
                            $activity_select.find('option').not(':first').remove();
                            $.each(data, function(key, result) {
                                let $option = "<option value='"+result.id+"'>"+result.code+""+result.title+"</option>";
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

                $get_info_button.addClass('hidden');
                //clear output
                clearOutput();

                fetch_activity_details($requisition_type_id,$project_id,$activity_id,$region_id,$fiscal_year);
            });

        function fetch_activity_details(requisition_type_id,project_id,activity_id,region_id,fiscal_year){
            $.get("{{ route('requisition.get_json') }}", { requisition_type_id: requisition_type_id,project_id: project_id, activity_id: activity_id, region_id: region_id, fiscal_year: fiscal_year},
                function(data, status){
                    if(data){

                        let $available_budget = data.actual-data.pipeline;
                        $project_title.text(data.project);
                        $activity_title.text(data.activity);
                        $requisition.text(data.requisition_type);
                        $sub_program.text(data.sub_program_area);
                        $numeric_output.text(data.numeric_output);
                        $output_unit.text(data.output_unit);

                        let $budget_amount = 'USD '+(data.budget/data.exchange_rate).toLocaleString();
                        let $available_budget_amount = 'USD '+($available_budget/data.exchange_rate).toLocaleString();
                        let $actual_amount = 'USD '+(data.actual/data.exchange_rate).toLocaleString();
                        let $commitment_amount = 'USD '+(data.commitment/data.exchange_rate).toLocaleString();
                        let $pipeline_amount = 'USD '+(data.pipeline/data.exchange_rate).toLocaleString();


                        $budget.text($budget_amount);
                        $actual.text($actual_amount);
                        $commitment.text($commitment_amount);
                        // $reprogrammed.text(data.)
                        $pipeline.text($pipeline_amount);
                        $available.text($available_budget_amount);
                        $budget_id_input.val(data.budget_id);

                        if($available_budget != 0){
                            $get_info_button.removeClass('hidden');
                        }

                    }else{
                        clearOutput();
                        $get_info_button.addClass('hidden');
                    }
                });
        }

        function clearOutput()
        {
            $project_title.text('');
            $activity_title.text('');
            $requisition.text('');
            $sub_program.text('');
            $numeric_output.text('');
            $output_unit.text('');
            $budget.text('');
            $actual.text('');
            $commitment.text('');
            $reprogrammed.text('');
            $pipeline.text('');
            $available.text('');
            $budget_id_input.empty();
        }


        });
    </script>
@endpush
