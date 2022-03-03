
@extends('layouts.app')

@section('content')

    @include('programactivity.display.generalSumarry')


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Submitted Reports</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body p-6">

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead >
                    <tr>

                        <th >Report Number</th>
                        <th >Status</th>
                        <th >Submission Date</th>
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($program_activity_reports AS $reports)
                        <tr>
                            <td>{{$reports->number}}</td>
                            <td>
                            @if($reports->wf_done == false)
                                <span class="text-warning">On Process</span>
                                @else
                                    <span class="text-success">Approved</span>

                                @endif
                            </td>
                            <td>{{$reports->created_at}}</td>
                            <td><a href="{{route('programactivityreport.show',$reports->uuid)}}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    </div>




    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Submitted Reports</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body p-6">
            <div class="col-md-12  col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Panel with custom buttons</h3>
                        <div class="card-options">
                            <a href="#" class="btn btn-primary btn-sm">Action 1</a>
                            <a href="#" class="btn btn-secondary btn-sm ml-2">Action 2</a>
                        </div>
                    </div>
                    <div class="card-body">
                        No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful actual teachings of the great explorer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


