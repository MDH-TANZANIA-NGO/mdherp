@extends('layouts.app')

@section('content')

    {{--    Workspace--}}

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('person.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-address-book-o text-primary"></i></div>
                        <div class="text-muted mb-0">Personal Details</div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('education.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-mortar-board text-primary"></i></div>
                        <div class="text-muted mb-0">Education</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('experience.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-black-tie text-primary"></i></div>
                        <div class="text-muted mb-0">Experience</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('timesheet.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-clock-o text-primary"></i></div>
                        <div class="text-muted mb-0">Timesheet</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('leave.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-briefcase text-primary"></i></div>
                        <div class="text-muted mb-0">Leave</div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('userbio.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-slideshare text-primary"></i></div>
                        <div class="text-muted mb-0">Know your Co-Workers</div>
                    </div>
                </div>
            </a>

        </div>
      {{--  <div class="col-4 col-sm-4 col-lg-3">
            <a href="">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-balance-scale text-primary"></i></div>
                        <div class="text-muted mb-0">Contributions</div>
                    </div>
                </div>
            </a>

        </div>--}}
{{--        <div class="col-4 col-sm-4 col-lg-3">
            <a href="">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-bank text-primary"></i></div>
                        <div class="text-muted mb-0">Bank Details</div>
                    </div>
                </div>
            </a>

        </div>--}}

    </div>
@endsection
