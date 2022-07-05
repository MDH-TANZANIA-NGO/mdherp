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
                <input type="submit" value="next" class="btn btn-primary">
            </div>
        </div>
    </div>
 
@endsection