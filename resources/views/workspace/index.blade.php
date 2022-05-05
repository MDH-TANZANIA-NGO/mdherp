@extends('layouts.app')

@section('content')

{{--    @include('workspace.under_construction')--}}

    <div class="row">

       <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('requisition.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cash multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Business Requisition</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('safari.index')}}">
                <a href="{{route('safari.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-subway multiple-outline text-primary" ></i></div>
                        <div class="text-muted mb-0">Safari Advance</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('programactivity.workspace')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fe fe-activity multiple-outline text-primary" ></i></div>
                        <div class="text-muted mb-0">Program Activities</div>
                    </div>
                </div>
            </a>

        </div>

        {{--<div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('stock.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cart multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0"> Supply Chain</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('fleet.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-car multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Fleet </div>
                    </div>
                </div>
            </a>

        </div>--}}

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('retirement.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-receipt multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Retirements</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('account.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-handshake-o multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Human Resource</div>
                    </div>
                </div>
            </a>
        </div>

      {{--  <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('listing.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa- text-primary"></i></div>
                        <div class="text-muted mb-0">Hire Requisition</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{ route('leave.index') }}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-receipt multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Leave</div>
                    </div>
                </div>
            </a>
        </div>--}}


    </div>
@endsection
