@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('job_management.settings.skills')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-gear"></i></div>
                    <div class="text-muted mb-0">Create Skills</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('job_management.settings.experience')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Create Experience</div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                <tr>
                    <td> {{ $designation->name }}</td>
                    <td> <a href="{{ route('job_management.settings.designation.show',$designation->id) }}">Set Skills & Experince</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
