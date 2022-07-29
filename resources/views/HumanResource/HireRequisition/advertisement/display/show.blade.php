@extends('layouts.app')
@section('content')
    <div class="align-content-center">
        <div class="row" style="font-size: large">
            <span class="col-lg-12" style="margin-top: 10px"><b>Job Advertisement Request </b></span>
        </div>
    </div>

    <!-- start: page -->
   
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>
 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title"> {{ $_advertisement->title }} </h3>
                        <div class="card-title">
                           
                        Number: <span> {{ $_advertisement->number }} </span> 
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $_advertisement->description !!}
                    </div>
                </div>
            </div>
        </div>
   


    

@endsection