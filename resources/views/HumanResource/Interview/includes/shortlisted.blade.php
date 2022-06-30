
<div class="row mb-3">


    <label class="label col-sm-2 ">Interview Date </label>
    <div class="col-sm-8 ">
        <input type="date" class="form-control" name="interview_date"> 
    </div>
    <div class="col-sm-2 ">
        <input type="submit" class="btn btn-primary btn-inline-block" name="submit" value="Add"> 
    </div>

</div>

<div class="row mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
			<h3 class="card-title">ShortList</h3>
			<h3 class="card-title">ShortList Number </h3>
		</div>
        <div class="card-body">
            
                @csrf
                <input type="hidden" value="{{ $interview->id }}" name="interview_id">
                @include('HumanResource.interview.datatables.shortlisted')
            
        </div>
    </div>
 </div>
 