@extends('layouts.app')
@section('content')
    {{--    Workspace--}}

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('financial-report.paymentBatches')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cash multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Payment Batches</div>
                    </div>
                </div>
            </a>

        </div>

{{--        <div class="col-4 col-sm-4 col-lg-3">--}}
{{--            <a href="{{ route('fleet.index') }}">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <div class="h2 m-0"><i class="mdi mdi-file-document multiple-outline text-primary"></i></div>--}}
{{--                        <div class="text-muted mb-0">Statements </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--        </div>--}}


{{--        <div class="col-4 col-sm-4 col-lg-3">--}}
{{--            <a href="#">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <div class="h2 m-0"><i class="fa fa-handshake-o multiple-outline text-primary"></i></div>--}}
{{--                        <div class="text-muted mb-0">Reconciliation</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
        {{--<div class="col-4 col-sm-4 col-lg-3">
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
