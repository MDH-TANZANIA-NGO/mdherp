@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('job_management.settings.storeExperience') }} " method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Experience</label>
                        <textarea class="form-control" name="description" rows="7" placeholder="Skill here.."></textarea>
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
                            <th> Experience</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $experience)
                        <tr>
                            <td>{{ $experience->description }}</td>
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