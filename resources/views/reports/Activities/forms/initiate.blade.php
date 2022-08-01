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
                @if(access()->user()->assignedSupervisor())

                    {!! Form::open(['route' => ['programactivity.store','method'=>'GET']]) !!}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('requisition_training_id', __("Requisition Number"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('requisition_training_id', $trainings, null,['class' => 'form-control select2-show-search', 'required']) !!}
                                    {!! $errors->first('requisition_training_id', '<span class="badge badge-danger">:message</span>') !!}
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
                            <button type="submit" class="btn btn-outline-success" style="margin-left: 30%" ><i class="fa fa-filter"></i>Filter</button>


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
                    <div class="tags">
                        <div class="tag">
                            Requisition number
                            <span class="tag-addon tag-blue">MB1233020</span>
                        </div>
                        <div class="tag">
                            Code number
                            <span class="tag-addon tag-success">92038929202</span>
                        </div>
                        <div class="tag">
                            Amount Requested
                            <span class="tag-addon tag-success">30000000</span>
                        </div>
                        <div class="tag">
                            Expected participants
                            <span class="tag-addon tag-success">100</span>
                        </div>
                        <div class="tag">
                            Attended participants
                            <span class="tag-addon tag-success">20</span>
                        </div>
                    </div>
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
                                    <li><a href="#tab6" data-toggle="tab" class="">Report</a></li>
                                    <li><a href="#tab7" data-toggle="tab" class="">Attachments</a></li>
                                    <li><a href="#tab8" data-toggle="tab" class="">Payments</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                                        <li class="acc_section">
                                            <div class="acc_head"><h3>Hotspot: Juliana Pub; Date: 22-07-2022; Location: Mikocheni </h3></div>
                                            <div class="acc_content" style="">
                                                @include('reports.Activities.datatables.attendances.index')

                                            </div>
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

@endsection



