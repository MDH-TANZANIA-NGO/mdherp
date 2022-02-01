@extends('layouts.app')
@section('content')
   @if($requisition->count() > 0)
       {!! Form::open(['route' => ['requisition.description',$requisition],'class'=>'card']) !!}
       <div class="row">
           <div class="col-xl-12 col-lg-12 col-md-12">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="text" value="{{$requisition->uuid}}" hidden name="uuid">
                       <br>
                       {!! Form::label('from', __("Description"),['class'=>'form-label','required_asterik']) !!}
                       {!! Form::textarea('description',$requisition->descriptions,['class' => 'form-control', 'placeholder' => '','required']) !!}
                   </div>
               </div>
               <button type="submit" class="btn btn-outline-info" style="margin-left:40%;margin-bottom: 2%">Submit and Continue</button>
               <br>
           </div>

       {!! Form::close() !!}
   @endif

@endsection
