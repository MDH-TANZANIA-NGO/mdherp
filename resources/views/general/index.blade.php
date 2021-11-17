@extends('layouts.app')

@section('content')

    {{--    Workspace--}}

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('g_scale.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cash multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Government Perdm Rates</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('unit.unit')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cash multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Stock units</div>
                    </div>
                </div>
            </a>

        </div>

    </div>
@endsection
