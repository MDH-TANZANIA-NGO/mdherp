@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => ['leave.update',$leave], 'method' => 'put']) !!}
    @csrf
    <!-- Large Modal -->

            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Edit Leave Request</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Leave Type</label>
                            {!! Form::select('leave_type_id', $leaveTypes, $leave->leave_type_id,['class' => 'form-control select2-show-search', 'required']) !!}
                            @error('leave_type_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            {!! Form::label('employee_id', __("Select Co-worker in your absence"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('employee_id', $users, $leave->employee_id,['class' => 'form-control select2-show-search', 'required']) !!}
                            {!! $errors->first('employee_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>

                    </div>
                    &nbsp;
                    &nbsp
                    <div class="row">
                        <div class="col-md-12" >
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" rows="2"  >{{$leave->comment}}</textarea>
                            @error('comment')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6" >
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="start_date" value="{{$leave->start_date}}" type="date">
                            </div>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                        <div class="col-md-6" >
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="end_date"  value="{{$leave->end_date}}" type="date">
                            </div>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp
                    &nbsp;
                    <div class="row">

                        <div class="col-12">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-azure"> Update Leave</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        <!-- End Row -->
    {!! Form::close() !!}
@endsection
