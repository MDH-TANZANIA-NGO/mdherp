@extends('layouts.app')
@section('content')
    <div class="row pull-right">
        <a href="#" class="btn btn-info" > <i class="fa fa-paper-plane-o"></i> Send for approval</a>
    </div>
    <br><br><br>
    <div class="row">
    <div class="col-md-12  col-xl-12">
        <div class="card">
            <div class="card-status bg-blue "></div>
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title"></h3>--}}
{{--                <div class="card-options">--}}
{{--                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
{{--                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="card-body">
{{--                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">View modal</button>--}}
                @if(access()->user()->assignedSupervisor())

                    {!! Form::open(['route' => ['activity_report.initiate'], 'method'=>'GET']) !!}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('requisition_id', __("Requisition Number"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('requisition_id', $trainings, null,['class' => 'form-control select2-show-search','placeholder'=>'Select approved requisition', 'required']) !!}
                                    {!! $errors->first('requisition_id', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('start_date', __("From"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::date('start_date', null,['class' => 'form-control', 'required']) !!}
                                    {!! $errors->first('start_date', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('end_date', __("To"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::date('end_date', null,['class' => 'form-control ', 'required']) !!}
                                    {!! $errors->first('requisition_training_id', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success" style="margin-left: 30%"  id="filter"><i class="fa fa-filter"></i>Filter</button> <a href="{{route('activity_report.initiate')}}" class="btn btn-outline-info" style="margin-left: 1%"> <i class="fa fa-undo"></i> Reset</a>


                            {!! Form::close() !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                @else
                    You Have no supervisor
                @endif </div>
        </div>
    </div>

    </div>
{{--    @include('reports.Activities.hotspots')--}}

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    @if($requisition)
                        <div class="tags">
                            <div class="tag">
                                Requisition number
                                <span class="tag-addon tag-blue">{{$requisition->number}}</span>
                            </div>
                            <div class="tag">
                                Code number
                                <span class="tag-addon tag-success">{{$requisition->code}}</span>
                            </div>
                            <div class="tag">
                                Amount Requested
                                <span class="tag-addon tag-success">{{$requisition->amount}}</span>
                            </div>
                            <div class="tag">
                                Expected participants
                                <span class="tag-addon tag-success">{{$requisition->trainingCost()->get()->count()}}</span>
                            </div>
                            <div class="tag">
                                Attended participants
                                <span class="tag-addon tag-success">{{$requisition->hotspots()->get()->count()}}</span>
                            </div>
                        </div>
                    @endif
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1 ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#tab5" class="active" data-toggle="tab">Attendance</a></li>
                                    <li><a href="#tab8" data-toggle="tab" class="">Payments</a></li>
                                    <li><a href="#tab6" data-toggle="tab" class="">Report</a></li>
                                    <li><a href="#tab7" data-toggle="tab" class="">Attachments</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                                        <li class="acc_section">

                                            @if(!$requisition)
                                                <div class="expanel-body">
                                                    You have not select approved requisition (No data available)
                                                </div>
                                            @elseif($requisition || !$hotspots)
                                                <div class="expanel-body">
                                                    No hotspot available <b class="text-danger">(attendance was not captured)</b>
                                                </div>
                                            @else
                                            @foreach($hotspots as $hotspot)
                                            <div class="acc_head">

                                                <h3>Hotspot: {{$hotspot->camp}}; Date: {{$hotspot->checkin_time}}; Location: {{$hotspot->checkin_location}} </h3></div>

                                            <div class="acc_content" style="">
                                                @include('reports.Activities.datatables.attendances.index')

                                            </div>
                                            @endforeach
                                                @endif
                                        </li>


                                    </ul> </div>
                                <div class="tab-pane" id="tab6">
                             @include('reports.Activities.forms.summary.create')
                                </div>
                                <div class="tab-pane" id="tab7">
                             @include('reports.Activities.forms.attachments.create')
                                </div>
                                <div class="tab-pane" id="tab8">
                                    @include('reports.Activities.datatables.payments.requisition-participants')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Swap with</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['activity_report.initiate'], 'method'=>'GET']) !!}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('participant_uid', __("Select attended Participant"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('participant_uid', $participants_attended, null,['class' => 'form-control select2-show-search','placeholder'=>'Select attended participant', 'required']) !!}
                                    {!! $errors->first('participant_uid', '<span class="badge badge-danger">:message</span>') !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Swap Participant</button>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--            @push('after-scripts')--}}
{{--                <script>--}}
{{--                    $(document).ready(function () {--}}
{{--                        let $requisition_id = $("select[name='requisition_id']").val();--}}
{{--                        let $filter = $("#filter");--}}
{{--                        let $start_date = $("input[name='start_date']").val();--}}
{{--                        let $end_date = $("input[name='end_date']").val();--}}

{{--                        $filter.click(function (event){--}}
{{--                            $.ajax({--}}
{{--                                url: "activity_report.initiate",--}}
{{--                                type:"GET",--}}
{{--                                data:{--}}
{{--                                    "_token": "{{ csrf_token() }}",--}}
{{--                                    requisition_id:$requisition_id,--}}
{{--                                    start_date:$start_date,--}}
{{--                                    end_date:$end_date,--}}
{{--                                }--}}

{{--                        });--}}
{{--                    })});--}}


{{--                </script>--}}

{{--    @endpush--}}



