@if(count($schedules))
    
      
    <div class="card">
        <div class="card-header">
          APPLICANTS INVITED FOR INTERVIEW
        </div>
        <div class="card-body">
            
            <input type="hidden" name="interview_id" value="{{ $interview->id }}">
            <ul class="demo-accordion accordionjs m-0" data-active-index="false">
            
                @foreach($schedules as $schedule)
                    <?php
                        $_schedule =  \DB::table('hr_interview_schedules')->where('id',$schedule)->first();
                        $total_scheduled_applicants = \DB::table('hr_interview_applicants')->where('interview_schedule_id',$schedule)->count();
                    ?>
                    <li class="acc_section">
                        <div class="acc_head d-flex justify-content-between">
                            <h3> Interview Date : {{ $_schedule->interview_date }} | Total Candidate : ({{ $total_scheduled_applicants  }}) </h3>
                        </div>
                        <div class="acc_content" style="display: none;">
                            @include('HumanResource.Interview.datatables.scheduled')
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>         
@endif