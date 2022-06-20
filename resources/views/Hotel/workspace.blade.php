@extends('layouts.app')
@section('content')
    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('admin.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-local-hotel multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Hotels</div>
                    </div>
                </div>
            </a>

        </div>


        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('programactivity.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-balance multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Vendors</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="{{route('programactivity.index')}}">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-bus multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Safaris</div>
                    </div>
                </div>
            </a>
        </div>
    </div>


@endsection
