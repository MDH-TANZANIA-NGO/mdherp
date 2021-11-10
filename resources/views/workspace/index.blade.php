@extends('layouts.app')

@section('content')

{{--    Workspace--}}
<a href="{{route('userslist')}}">
    <div class="card" style="width: 15%">
        <div class="card-body text-center">
            <div class="h2 m-0"><i class="mdi mdi-cash-multiple text-blue"></i> </div>Business Requisition

        </div>
    </div>

</a>

<a href="{{route('fleet.index')}}">
    <div class="card" style="width: 15%; align-content: center">
        <div class="card-body text-center">
            <div class="h2 m-0"><i class="mdi mdi-car text-blue"></i> </div>

            Fleet Management

        </div>
    </div>

</a>

@endsection
