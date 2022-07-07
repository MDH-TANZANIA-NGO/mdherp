@extends('layouts.app')
@section('content')
@csrf

<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW REPORT </h3>
    </div>
<div class="card-body">
    <form action="{{ route('interview.report.initiate') }} " method="post">
        @csrf
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="form-label">Job </label>
                    {!! Form::select('hr_requisition_job_id',$designations,null,['class' => 'form-control select2', 'placeholder'=>'Select Job','required']) !!}
                </div>
            </div>
            <!-- <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label class="form-label">Interview Type</label>
                                    

                                </div>
                            </div> -->

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Initiate</button>
                </div>
            </div>
        </div>
    </form>
</div>



@endsection
@push('after-scripts')
<script>
    $('.summernotecontent').summernote({
        height: 140,
        spellCheck: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen']]
        ]
    });
</script>
@endpush