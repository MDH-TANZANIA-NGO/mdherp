@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('job_management.settings.storeSkill') }} " method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Skill Category</label>
                        {!! Form::select('skill_category_id',$skill_categories,null,['class' => 'form-control select2 custom-select', 'placeholder'=>'Select Category','required']) !!}
                    </div>
                    <div class="form-group">
                        <label class="form-label">Skill</label>
                        <textarea class="form-control" name="name" rows="7" placeholder="Skill here.."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Skill</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skills as $skill)
                            <tr>
                                <td> {{ $skill->category->name }}</td>
                                <td>{{ $skill->name }}</td>
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