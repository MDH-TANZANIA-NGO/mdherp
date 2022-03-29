@extends('layouts.app')

@section('content')

    {!! Form::open(['route' => ['leave.store']]) !!}
    @csrf

 @if(access()->user()->assignedSupervisor() == null)

     <div class="row">
         <div class="col-12 col-sm-12">
             <div class="card ">
                 <div class="card-header">
                     <p style="margin-left: 40%; font-size: large"> You have not been assigned supervisor</p>

                 </div>
                 <div>

                 </div>
             </div>
         </div>
     </div>



 @else
    <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Leave Request</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Leave Type</label>
                            {!! Form::select('leave_type_id', $leaveTypes, null,['class' => 'form-control select2-show-search', 'required']) !!}
                            {{--<select name="leave_type_id" id="select-level" class="form-control  select2-search-show">
                                <option value=""  disabled selected hidden>Select Type</option>
                                @foreach($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{$leaveType->name}}</option>
                                @endforeach
                            </select>--}}
                            @error('leave_type_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            {!! Form::label('employee_id', __("Select Co-worker in your absence"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('employee_id', $users, null,['class' => 'form-control select2-show-search', 'required']) !!}
                            {!! $errors->first('employee_id', '<span class="badge badge-danger">:message</span>') !!}
                           {{-- <label class="form-label">Select Co-worker in your absence</label>
                            <select name="employee_id" id="select-level" class="form-control select2-search-show">
                                <option value=""  disabled selected hidden>Select Type</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{$user->fullName}}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror--}}
                        </div>

                    </div>
                    &nbsp;
                    &nbsp
                    <div class="row">
                        <div class="col-md-12" >
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" rows="2" placeholder="Comment..." ></textarea>
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
                                </div><input class="form-control" name="start_date" placeholder="MM/DD/YYYY" type="date">
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
                                </div><input class="form-control" name="end_date" placeholder="MM/DD/YYYY" type="date">
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
                                <button type="submit" class="btn btn-azure"> Request Leave</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-12 col-md-6" style="margin-left: 25%">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leave Balances</h3>
                        <div class="card-options ">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($leave_balances AS $leave_balances)
                            <li class="list-group-item justify-content-between">
                                {{$leave_balances->leaveType->name}}
                                @if($leave_balances->remaining_days <= 3 && $leave_balances->remaining_days > 0)
                                <span class="badgetext badge badge-warning badge-pill">{{$leave_balances->remaining_days}}</span>
                                @elseif($leave_balances->remaining_days >3 )
                                    <span class="badgetext badge badge-success badge-pill">{{$leave_balances->remaining_days}}</span>
                                @elseif($leave_balances->remaining_days == 0)
                                    <span class="badgetext badge badge-danger badge-pill">{{$leave_balances->remaining_days}}</span>
                                    @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        </div>
    {!! Form::close() !!}

@endif

@endsection

