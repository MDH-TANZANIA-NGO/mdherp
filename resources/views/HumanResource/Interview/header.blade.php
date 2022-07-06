<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  {{ $job_title->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  {{ $interview_type->name }} </span>
		    <!-- <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span> -->
            @if(!isset($show))
                @include('HumanResource.Interview.form.send_notification_button')
            @endif
		</div>
    </div>
</div>