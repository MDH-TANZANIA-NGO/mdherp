@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  {{ $hrHireRequisitionJob->designation->name  }} </span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span>
		</div>
    </div>
</div>
    @if(count($schedules))
    <form action="{{ route('interview.notifyapplicant') }} " method="post">
        @csrf
        <input type="submit" value="Send Notification" class="btn btn-primary">
        <input type="text" name="interview_id" value="{{ $interview->id }}">
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
                    @include('HumanResource.interview.datatables.scheduled')
                </div>
            </li>
            @endforeach
        </ul>
    </form>
    @endif
<form action="{{ route('interview.addapplicant') }} " method="post">
    @include('HumanResource.interview.includes.shortlisted')   
</form>
@endsection