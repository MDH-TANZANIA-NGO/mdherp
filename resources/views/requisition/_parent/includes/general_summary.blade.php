<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Description</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <p>{{$requisition->descriptions}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(152, 186, 217)">
                <h3 class="card-title">REQUISITION SUMMARY</h3>
            </div>
            <div class="card-body">
                @if($requisition->user_id==access()->id())
                    <div class="">
                        <h4 class="mb-1">Hi <strong>{{ $requisition->user->full_name_formatted }}</strong>,</h4>
                        You have requested Amount of <strong>{{number_2_format($requisition->amount)}}</strong> (TZS) for line activity:
                        <p><b>{{$requisition->activity->code}} </b>{{$requisition->activity->title}}</p>
                    </div>
                @else
                    <h4><strong>{{ $requisition->user->full_name_formatted }}</strong>,</h4>
                    Have requested Amount of <strong>{{number_2_format($requisition->amount)}}</strong> (TZS) for line item:
                    <div class="">
                        <p><b>{{$requisition->activity->code}} </b>{{{$requisition->activity->title}}}</p>
                    </div>
                @endif

                    <div class="dropdown-divider"></div>
                <!-- Row -->
                    <div class="row pt-4">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Project name:
                                    <span class="badgetext badge badge-primary badge-pill">{{ $requisition->project_title}}</span>
                                </li>
                                <li class="list-group-item">
                                    Sub Program area:
                                    <span class=" badgetext badge badge-primary badge-pill">{{ $requisition->program_area_title}}</span>
                                </li>
                                <li class="list-group-item">
                                    Numeric Output:
                                    <span class=" badgetext badge badge-primary badge-pill">{{ $requisition->numeric_output }}/{{ $requisition->budget->numeric_output }}</span>
                                </li>
                                <li class="list-group-item">
                                    Fiscal Year:
                                    <span class=" badgetext badge badge-primary badge-pill">{{ $requisition->budget->fiscalYear->title }}</span>
                                </li>
                                <li class="list-group-item">
                                    Region:
                                    <span class=" badgetext badge badge-primary badge-pill">{{ $requisition->region->name }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Budgeted Amount
                                    <span class="badgetext badge badge-default badge-pill">{{number_2_format($budget->amount)}}</span>
                                </li>
                                <li class="list-group-item">
                                    Actual Expenditure
                                    <span class="badgetext badge badge-default badge-pill">{{number_2_format($payed_and_closed)}}</span>
                                </li>
                                <li class="list-group-item">
                                    Commitment
                                    <span class=" badgetext badge badge-default badge-pill">{{number_2_format($approved_requisitions)}}</span>
                                </li>
                                <li class="list-group-item">
                                    Pipeline
                                    <span class=" badgetext badge badge-default badge-pill">{{number_2_format($not_approved_requisitions)}}</span>
                                </li>
                                <li class="list-group-item">
                                    Available
                                    <span class=" badgetext badge badge-default badge-pill">{{number_2_format(($budget->amount)-(($payed_and_closed)+($approved_requisitions)+($not_approved_requisitions)))}}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- End Row -->







            </div>

        </div>
    </div>

</div>









