@extends('layouts.app')
@section('content')
@include('HumanResource.interview.header')
<form action="{{ route('interview.addpanelist') }} " method="post">
    @csrf
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Panelists</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="form-label">Panelist </label>
                    </div>
                    <div class="col-lg-8">
                        {!! Form::select('panelist_id[]',$users,null,['class' => 'form-control select2','multiple'=>'true','data-placeholder'=>'Select panelists','required']) !!}
                    </div>
                </div>
                <input type="submit" value="next" class="btn btn-primary">
                <input type="hidden" name="hr_requisition_job_id" value="{{ $interview->hr_requisition_job_id }}">
                <input type="hidden" name="interview_id" value="{{ $interview->id }}">
            </div>
        </div>
    </div>
</form>
@endsection