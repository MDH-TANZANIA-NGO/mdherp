@extends('layouts.app')
@section('content')
    <div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
        <div class="row text-center" style="font-size: large">
            <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>Hire Requisition </b></span>
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
                        <h3 class="card-title"> Number: <span> {{ $hireRequisition->number }} </span> </h3>
                        <div class="card-title">
                            Department: <span> {{ $hireRequisition->department }} </span>

                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="demo-accordion accordionjs m-0" data-active-index="false">
                        <?php $total_jobs = count($hireRequisitionJobs); ?>
                        @foreach($hireRequisitionJobs as $job)
                            @include('HumanResource.HireRequisition._parent.display.hr_job')
                        @endforeach
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>





@endsection
