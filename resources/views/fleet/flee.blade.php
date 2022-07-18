@extends('layouts.app')

@section('content')

{{-- Workspace--}}

<div class="row">

    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('fleet.index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-user-plus multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Request</div>
                </div>
            </div>
        </a>

    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('fleet.index2')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-car multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Register</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('distance-index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fas fa-road multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Route</div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('distance-show')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-list multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Route List</div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('driver-index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-list multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Assign Driver</div>
                </div>
            </div>
        </a>
    </div>



</div>
@endsection