@extends('layouts.app')
@section('content')
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
{{--                                                        @include('reports.Activities.datatables.attendances.index')--}}

                                                    </div>
                                                @endforeach
                                            @endif
                                        </li>


                                    </ul> </div>
                                <div class="tab-pane" id="tab6">
{{--                                    @include('reports.Activities.forms.summary.create')--}}
                                </div>
                                <div class="tab-pane" id="tab7">
                                    @include('reports.Activities.display.attachments')
                                </div>
                                <div class="tab-pane" id="tab8">
                                    @include('reports.Activities.display.payments')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
