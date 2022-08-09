@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> {{ $designation->name }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('job_management.settings.storeDesignationSkill') }} " method="post">
                    @csrf
                    <input type="hidden" name="designation_id" value="{{$designation->id}}">
                    <div class="form-group">
                        <label class="form-label">Skill</label>
                        {!! Form::select('skill_id',$skills,null,['class' => 'form-control select2 custom-select', 'placeholder'=>'Select Category','required']) !!}
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('job_management.settings.storeDesignationExperience') }} " method="post">
                    @csrf
                    <input type="hidden" name="designation_id" value="{{$designation->id}}">
                    <div class="form-group">
                        <label class="form-label">Experience</label>
                        {!! Form::select('hr_hire_experience_id',$experiences,null,['class' => 'form-control select2 custom-select', 'placeholder'=>'Select Category','required']) !!}
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Skill</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designation_skills as $designation_skill)
                        <tr>
                            <td>{{ $designation_skill->name }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Experience</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designation_experiences as $designation_experience)
                        <tr>
                            <td>{{ $designation_experience->description }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection