@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Induction Schedule for {{$inductionSchedule->designation->getFullTitleAttribute()}} </p>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'induction_schedule.store']) !!}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="date" placeholder="MM/DD/YYYY" type="datetime-local">
                            </div>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            {!! Form::select('department_id',$departments, null,['class' => 'form-control select2', 'placeholder'=>'Select','required']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Area</label>
                            <div class="input-group">
                                <textarea class="form-control" name="area" rows="3" placeholder="Area..." ></textarea>
                                <input name="induction_schedule_id" value="{{$inductionSchedule->id}}" class="hidden">
                                @error('area')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
        <div class="card-header">
            <h3 class="card-title">Induction Schedule For {{$inductionSchedule->designation->getFullTitleAttribute()}}</h3>
            <div class="card-options">
                <a href="{{route('induction_schedule.addParticipants', $inductionSchedule)}}" class="btn btn-primary">Click here to Add Participants</a>
            </div>
        </div>
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
