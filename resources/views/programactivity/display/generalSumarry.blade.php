
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Activity Summary</h3>
                <a href="{{route('requisition.show', $requisition_uuid)}}" class="btn btn-sm btn-info float-right" style="margin-left: 75%"><i class="fa fa-info-circle"></i>
                    {{$requisition->number }}
                </a>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="tags">

                    <div class="tag tag-primary">
                        {{$activity_location}}
                        <span class="tag-addon"><i class="fe fe-map-pin"></i></span>
                    </div>

                    <div class="tag">
                        start date
                        <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($activity_details->start_date) )}}</span>
                    </div>
                    <div class="tag">
                        end date
                        <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($activity_details->end_date))}}</span>
                    </div>
                    <span class="tag tag-default">
														Total Participants
														<span class="tag-addon tag-warning">{{$activity_participants_count}}</span>
													</span>
                    <span class="tag tag-default">
														 Participants Attended
														<span class="tag-addon tag-success">{{$activity_participants_count}}</span>
													</span>
                    <span class="tag tag-default">
														Participants Not Attended
														<span class="tag-addon tag-danger">{{$activity_participants_count}}</span>
													</span>
                    <span class="tag tag-default">
														Total Items
														<span class="tag-addon tag-warning">{{$training_items_count}}</span>
													</span>
                </div>

            </div>
        </div>
    </div>

