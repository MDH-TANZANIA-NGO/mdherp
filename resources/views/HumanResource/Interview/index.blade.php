@extends('layouts.app')
@section('content')
   
<div class="row">
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('interview.list')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Create Interview</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('interview.result')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Interview Result</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('interview.report.index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Interview Report</div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection