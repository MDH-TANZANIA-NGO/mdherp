@extends('layouts.app')
@section('content')

    {!! Form::open(['route' => ['admin.updateService', $service->id],'class'=>'card']) !!}


    <div class="input-group">
        <input type="text" class="form-control" value="{{$service->name}}" name="name" placeholder="Add service name">
        <span class="input-group-append">
													<button class="btn btn-primary" type="submit">Update!</button>
												</span>
    </div>

    {!! Form::close() !!}

@endsection
