@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SWAP <b>{{$existing_participant->first_name}}  {{$existing_participant->last_name}}</b> WITH</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['programactivity.updateParticipant',$existing_participant]]) !!}
                {!! Form::select('new_participant_id',$gofficers, null, ['class' => 'form-control select2-show-search', 'required','style'=>'width:100%']) !!}
                {!! Form::number('requisition_training_cost_id', $requisition_training_cost_id, ['hidden']) !!}
                {!! Form::number('old_participant_id', $existing_participant->id, ['hidden']) !!}
                {!! Form::text('activity_uuid', $activity_uuid, ['hidden']) !!}
                <button type="submit" class="btn btn-outline-info" style="margin-left:40%; margin-top: 2%;" >Save Changes</button>
                {!! Form::close() !!}


            </div>
        </div>
    </div>

@endsection
