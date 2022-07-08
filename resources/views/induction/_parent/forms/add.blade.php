@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => 'induction_schedule.participants', 'method' => 'post',]) !!}
    <!-- Large Modal -->
    <div class="col-lg-12 col-md-12">
        <div class="card">


            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold"> Add Participant(s)</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Select Participant(s)</label>
                        <input class="hidden" name="induction_schedule_id" value="{{$inductionSchedule->id}}">
                        {!! Form::select('participants[]', $participants, null, ['class' =>'form-control select2 custom-select', 'multiple','required']) !!}
                    </div>
                    @error('participants')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror

                </div>

                &nbsp;

                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">

                            <button type="submit" class="btn btn-azure"  >Add Participants </button>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
