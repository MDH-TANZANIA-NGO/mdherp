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

    <div class="card p-4 mb-4">
    <div class="card-header">
     Number: {{ $hireRequisition->number }}  
    </div>
    
    <form action=method="post">
        @csrf
        <div class="card-body">
                <table   class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">TITLE</th>
                        <th class="wd-15p">REGION</th>
                        <th class="wd-15p">DATE REQUIRED</th>
                        <th class="wd-25p"># OF EMPLOYEES</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        @foreach( $hireRequisitionJobs as $key=>$hireRequisitionJob )
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> {{ $hireRequisitionJob->title }} </td>
                            <td> {{ $hireRequisitionJob->regions  }}</td>
                            <td> {{ $hireRequisitionJob->date_required }} </td>
                            <td> {{ $hireRequisitionJob->empoyees_required  }} </td>
                            <td> <a href="#"> View </a> | <a href="#">Edit</a> | <a href="#">Delete</a> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        </div>
</form>
</div>

    

@endsection
