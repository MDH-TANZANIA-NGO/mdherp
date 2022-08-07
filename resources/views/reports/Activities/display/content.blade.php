<div class="latest-timeline">
    <ul class="timeline mb-0">
        <li class="mt-0">
            <h6><a target="_blank" href="#" class="text-dark fs-17">Venue name: {{$activity_report->venue}}</a></h6>
            <span class="text-muted fs-12">Submitted: {{date('d-M-Y', strtotime($activity_report->created_at))}}</span>
            <p>{!! $activity_report->content !!}</p>
        </li>

    </ul>
</div>
