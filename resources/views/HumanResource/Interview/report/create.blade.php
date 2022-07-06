@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE: {{ $job_title->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO : </span>
        </div>
    </div>
</div>

@csrf
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">INTERVIEW REPORT</h3>
        </div>
        <div class="card-body">
            @each('HumanResource.Interview.report.interveiw_list', $interviews, 'interview')
            @include('HumanResource.Interview.report.panelist_list')
            @include('HumanResource.Interview.report.recommendation_list')
            {!! Form::open(['route' => 'interview.report.store']) !!}
            <div class="form-group">
                <label class="form-lable">Recommendation Comment</label>
                <textarea class="summernotecontent" name="comment"></textarea>
            </div>
            <div class="form-group">
                @foreach($interviews as $interview)
                    <input type="hidden" name="interviews[]" value="{{$interview->id}}"> 
                @endforeach
                <input type="submit" value="Save" class="btn btn-success">
                <input type="submit" value="Submit for Approval" class="btn btn-primary">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
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