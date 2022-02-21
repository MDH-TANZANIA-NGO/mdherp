@extends('layouts.app')
@section('content')
   @if($requisition->count() > 0)
       {!! Form::open(['route' => ['requisition.description',$requisition],'class'=>'card']) !!}
       <!-- Row -->
       <div class="row">
           <div class="col-md-12 col-lg-12">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Panel with heading</h3>
                       <div class="card-options ">
                           <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                           <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                       </div>
                   </div>
                   <div class="card-body">
                       <div class="row mt-4">
                           <div class="col-md-6">
                               <div class="expanel expanel-default">
                                   {{--                                   <div class="expanel-heading">Panel heading without title</div>--}}
                                   <div class="expanel-body">
                                       <div class="form-group" >
                                           {!! Form::label('from', __("Numeric Output"),['class'=>'form-label','required_asterik']) !!}
                                           {!! Form::number('numeric_out_put',$requisition->numeric_output,['class' => 'form-control', 'placeholder' => 'Enter Numeric Output','required']) !!}

                                       </div>
                                       <div class="form-group" >
                                           {!! Form::label('from', __("Total Numeric Output"),['class'=>'form-label','required_asterik']) !!}
                                           {!! Form::number('Total_numeric_out_put',$requisition->budget->numeric_output,['class' => 'form-control', 'placeholder' => '','disabled']) !!}

                                       </div>
                                       <div class="form-group" >
                                           {!! Form::label('from', __("Output Unit"),['class'=>'form-label','required_asterik']) !!}
                                           {!! Form::text('out_put',$requisition->activity->outputUnit->title,['class' => 'form-control', 'placeholder' => '','disabled']) !!}

                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="expanel expanel-default">
                                   {{--<div class="expanel-heading">
                                       <h3 class="expanel-title">Panel title</h3>
                                   </div>--}}
                                   <div class="expanel-body">
                                       <div class="form-group">
                                           <input type="text" value="{{$requisition->uuid}}" hidden name="uuid">
                                           {!! Form::label('from', __("Description"),['class'=>'form-label','required_asterik']) !!}
                                           {!! Form::textarea('description',$requisition->descriptions,['class' => 'form-control', 'placeholder' => '','required', 'rows'=>'8']) !!}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-outline-info" style="margin-left:40%;margin-bottom: 2%">Submit and Continue</button>

                   </div>
               </div>
           </div>
       </div>
       <!-- End Row -->






                 <br>


       {!! Form::close() !!}
   @endif

@endsection
