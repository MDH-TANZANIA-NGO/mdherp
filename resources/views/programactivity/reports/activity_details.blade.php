<div class="col-md-12">
    <div class="card card-collapsed">
        <div class="card-header">
            <h3 class="card-title">Activity Report Details</h3>

            <div class="card-options">
                <a href="#" class="btn-sm">
                    <div class="tag">
                        Report Number
                        <span class="tag-addon tag-success">{{$program_activity_report->number}}</span>
                    </div>
                </a>
                <a href="{{route('programactivity.show',$program_activity_report->programActivity->uuid)}}" class="btn-sm ml-2">
                    <div class="tag">
                        Activity Number
                        <span class="tag-addon tag-success">{{$program_activity_report->programActivity->number}}</span>
                    </div>
                </a>
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">

            <div class="card-body">
                <b>Venue Name</b>
                <p>{{$program_activity_report->venue_name}}</p>

                <br>
                <b>Background Info</b>
                <p>{{$program_activity_report->background_info}}</p>

                <br>
                <b>What was Planned</b>
                <p>{{$program_activity_report->what_was_planned}}</p>

                <br>
                <b>Objectives</b>
                <p>{{$program_activity_report->objectives}}</p>

                <br>
                <b>Methodology</b>
                <p>{{$program_activity_report->methodology}}</p>

                <br>
                <b>Achievement</b>
                <p>{{$program_activity_report->achievement}}</p>

                <br>
                <b>Challenges</b>
                <p>{{$program_activity_report->challenges}}</p>

                <br>
                <b>Recommendations</b>
                <p>{{$program_activity_report->recommendations}}</p>


            </div>

        </div>
    </div>
</div>
