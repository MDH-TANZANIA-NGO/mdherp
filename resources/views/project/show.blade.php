@extends('layouts.app')
@section('content')
    {{-- <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">PROJECTS NAME: {{ $project->title }}</span>
    </div> --}}
    <div class="row">
        
        <div class="card-body">
            <div class="table-responsive">
                @include('project.form.edit')
            </div>
        </div>
    </div>

@endsection
