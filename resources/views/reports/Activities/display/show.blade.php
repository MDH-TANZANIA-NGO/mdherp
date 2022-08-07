@extends('layouts.app')
@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

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
{{--                                    <li><a href="#tab7" data-toggle="tab" class="">Attachments</a></li>--}}

                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                                        <li class="acc_section">

                                            @if($hotspots->count() == 0)
                                                <div class="expanel-body">
                                                    No hotspot available <b class="text-danger">(attendance was not captured)</b>
                                                </div>
                                            @else
                                             <div class="row">
                                                 <div class="col-md-3">
                                                     <a href="{{route('activity_report.export_attendance', $activity_report->uuid)}}" class="btn btn-outline-success" ><i class="fa fa-file-excel-o"></i> Export to Excel</a>

                                                 </div>

                                             </div>
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
                                    @include('reports.Activities.display.content')
                                </div>
                                <div class="tab-pane" id="tab7">
                                    @include('reports.Activities.display.attachments')
                                </div>
                                <div class="tab-pane" id="tab8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{route('activity_report.export_participants', $activity_report->uuid)}}" class="btn btn-outline-success" ><i class="fa fa-file-excel-o"></i> Export to Excel</a>

                                        </div>


                                    </div>
                                    <br>
                                    @if(in_array(access()->user()->designation_id, $finance_designations))
                                        @include('reports.Activities.datatables.payments.requisition-participants')

                                    @else
                                        @include('reports.Activities.display.payments')
                                        @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
