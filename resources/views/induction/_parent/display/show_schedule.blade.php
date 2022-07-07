@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="">EDIT INDUCTION SCHEDULE FOR - {{ $inductionSchedule->designation->getFullTitleAttribute()}} </h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['induction_schedule.updateSchedule', $inductionSchedule], 'method' => 'put']) !!}
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">Job </label>
                            {!! Form::select('designation_id',$designations, $inductionSchedule->designation_id,['class' => 'form-control select2', 'placeholder'=>'Select','required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="start_date" value="{{$inductionSchedule->start_date}}" type="date">
                            </div>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="end_date" value="{{$inductionSchedule->end_date}}" type="date">
                            </div>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['induction_schedule.markAsComplete', $inductionSchedule], 'method' => 'put']) !!}
                <button type="submit" class="btn btn-success">Mark As Completed</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Date</td>
                    <td>Department</td>
                    <td>Area</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @if(is_null($inductionScheduleItems))
                    <p>There are no items in this schedule yet</p>
                @else
                    @foreach($inductionScheduleItems AS $key => $inductionScheduleItem)
                        <tr>
                            <td>{{ $inductionScheduleItem->date }}</td>
                            <td>{{ $inductionScheduleItem->department->title }}</td>
                            <td>{!! $inductionScheduleItem->area !!}</td>
                            <td><a href="{{route('induction_schedule.show', $inductionScheduleItem->id)}}" class="btn btn-outline-success"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
