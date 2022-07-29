@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Edit Induction Schedule for {{$inductionScheduleItem->inductionSchedule->designation->getFullTitleAttribute()}} </p>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['induction_schedule.update', $inductionScheduleItem], 'method' => 'put']) !!}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="date" value="{{$inductionScheduleItem->date}}" type="datetime-local">
                            </div>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            {!! Form::select('department_id',$departments, $inductionScheduleItem->department_id,['class' => 'form-control select2', 'placeholder'=>'Select','required']) !!}
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Area</label>
                            <div class="input-group">
                                <textarea class="form-control" name="area" rows="3" placeholder="" >{{$inductionScheduleItem->area}}</textarea>
                                <input name="induction_schedule_id" value="{{$inductionScheduleItem->induction_schedule_id}}" class="hidden">
                                @error('area')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                @enderror
                            </div>
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
            </div>
        </div>
    </div>
@endsection
