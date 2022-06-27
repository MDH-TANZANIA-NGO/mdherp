@extends('layouts.app')

@section('content')

    {{--    Workspace--}}

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('hirerequisition.list') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-address-book-o text-primary"></i></div>
                        <div class="text-muted mb-0">Hire Requisition </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('advertisement.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                        <div class="text-muted mb-0">Advertisement</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('hr.job.application')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                        <div class="text-muted mb-0">Job Applications</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
