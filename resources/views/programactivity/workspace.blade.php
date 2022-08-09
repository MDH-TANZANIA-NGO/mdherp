@extends('layouts.app')

@section('content')

    {{--    Workspace--}}

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('programactivity.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-font multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Activities</div>
                    </div>
                </div>
            </a>

        </div>

{{--        <div class="col-4 col-sm-4 col-lg-3">--}}
{{--            <a href="{{route('programactivityreport.index')}}">--}}
{{--                --}}{{--                <a href="{{route('safari.index')}}">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <div class="h2 m-0"><i class="zmdi zmdi-book multiple-outline text-primary" ></i></div>--}}
{{--                        <div class="text-muted mb-0">Reports</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--        </div>--}}
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('activity_report.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-badge-check multiple-outline text-primary" ></i></div>
                        <div class="text-muted mb-0">Activity Reports</div>
                    </div>
                </div>
            </a>

        </div>
{{--        @if($supervisor != null)--}}
{{--            @if(access()->user()->id == $supervisor->supervisor_id)--}}

{{--                <div class="col-4 col-sm-4 col-lg-3">--}}
{{--                    <a href="{{route('programactivity.reports')}}">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body text-center">--}}
{{--                                <div class="h2 m-0"><i class="zmdi zmdi-badge-check multiple-outline text-primary" ></i></div>--}}
{{--                                <div class="text-muted mb-0">Report Approvals</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}

{{--                </div>--}}
{{--            @endif--}}
{{--        @endif--}}






    </div>
@endsection
