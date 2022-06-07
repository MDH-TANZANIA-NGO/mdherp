@extends('layouts.app')

@section('content')
<!--aside closed-->


<!--Row-->
<div class="row">

    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('meeting')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-handshake-o multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Meetings</div>
                </div>
            </div>
        </a>

    </div>

    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('event')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fa-calendar-plus-o multiple-outline text-primary"></i></div>
                    <div class="text-muted mb-0">Events</div>
                </div>
            </div>
        </a>

    </div>

    


    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('time')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="side-menu__icon fa fa-clock-o multiple-outline text-primary"> </i></div>
                    <div class="text-muted mb-0"> Time</div>
                </div>
            </div>
        </a>

    </div>

    
   

    
    
    


</div>
<!--End row-->
@endsection