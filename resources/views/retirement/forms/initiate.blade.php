
@extends('layouts.app')

@section('content')
    @if(access()->user()->assignedSupervisor())
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Initiate Retirement</h3>
                </div>
                <div class="card-body">


                    {!! Form::open(['route' => ['retirement.store']]) !!}
                    <div class="card-body">
                        <div class="row">

{{--                            <div class="col-md-6">--}}
{{--                                {!! Form::label('safari_advance_id', __("Retirement Type"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                {!! Form::select('retirement_type',$retirementtype, null,['class' => 'form-control select2-show-search', 'required']) !!}--}}

                                {{--<select name="retirement_type" class="form-control">
                                    <option value="0">Select Retirement Type</option>
                                    <option value="1">Safari Advance</option>
                                    <option value="2">Program activity</option>
                                </select>--}}
{{--                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('safari_advance_id', __("Safari Number"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('safari_advance_id', $safaries, null,['class' => 'form-control select2-show-search', 'required','id'=>'safari','style'=>'display:none']) !!}
                                    {!! $errors->first('safari_advance_id', '<span class="badge badge-danger">:message</span>') !!}

                                </div>
                            </div>
                           {{-- <div class="col-md-4" id="programactivity" style="display: none">
                                <div class="form-group">
                                    {!! Form::label('safari_advance_id', __("Program Activity Number"),['class'=>'form-label','required_asterisk']) !!}
                                    {!! Form::select('safari_advance_id', $programs, null,['class' => 'form-control select2-show-search', 'required','id'=>'safari']) !!}
                                    {!! $errors->first('safari_advance_id', '<span class="badge badge-danger">:message</span>') !!}

                                </div>
                            </div>--}}
                        </div>
                        &nbsp;
                            <div class="row">
                                <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Initiate Retirement</button>
                                </div>
                            </div>
            </div>
                    {!! Form::close() !!}

        </div>
    </div>
    @else
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
                            <div class="tab-content">

                                    <div class="card-body">
                                        <div class="align-content-center text-center">
                    You have not been assigned a supervisor in the system, Kindly contact IT personnel to assist you with that
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endif

        @push('after-scripts')

            <script>
                $(document).ready(function (){
                    let $retirement_type = $("select[name='retirement_type']");

                    $retirement_type.change(function (event){
                        if (this.value == '0'){
                            $("#safari").hide();
                            $("#programactivity").hide();

                        }
                        if (this.value == '1'){
                            $("#safari").show();
                            $("#programactivity").hide();

                        }
                        if (this.value == '2'){
                            $("#safari").hide();
                            $("#programactivity").show();


                        }
                    });
                });
            </script>
    @endpush

@endsection



