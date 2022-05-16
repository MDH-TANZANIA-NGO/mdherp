@extends('layouts.app')
@section('content')

    {!! Form::open(['route' => ['listing.update',$listing], 'method' => 'put']) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Update Hire Request</span>
            </div>

            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6" >
                    {!! Form::label('region_id', __("Select Department"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('region_id', $regions, $listing->region_id,['class' => 'form-control select2-show-search', 'required']) !!}
                    {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-6">
                    <label class="form-label">Job Title</label>
                    <input type="text" class="form-control" name="title" placeholder="ie. Senior Lab Technician"  value="{{$listing->title}}" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
            &nbsp;
            <div class="row">
                <div class="col-6" >
                    <label class="form-label">Number of Employees</label>
                    <input type="number" class="form-control" name="number" placeholder="ie. 1, 4" value="{{$listing->number}}" required>
                    @error('number')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6">
                    {!! Form::label('region_id', __("Select Department"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('region_id', $regions, $listing->region_id,['class' => 'form-control select2-show-search', 'required']) !!}
                    {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" id="job_description" name="content" rows="4" required>
                        {{$listing->content}}
                    </textarea>
                </div>
                @error('content')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;

            <div class="row">
                <div class="col-6">
                    {!! Form::label('date_required', __("Date Required"),['class'=>'form-label','required_asterik']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" value="{{ $listing->date_required }}" name="date_required"  type="date" min="1997-01-01" required>
                    </div>
                    {!! $errors->first('date_required', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-6">
                    {!! Form::label('prospect_for_appointment_cv_id', __("Prospect for Appointment"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('prospect_for_appointment_cv_id', $prospects, $listing->prospect_for_appointment_cv_id, ['class' =>'form-control custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('prospect_for_appointment_cv_id', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Education</label>
                    <textarea class="form-control" id="education" name="education_and_qualification" rows="4" required>
                        {{$listing->education_and_qualification}}
                    </textarea>
                </div>
                @error('education_and_qualification')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Practical Experience</label>
                    <textarea class="form-control" id="practical" name="practical_experience" rows="4" required>
                        {{$listing->practical_experience}}
                    </textarea>
                </div>
                @error('practical_experience')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Other Qualities</label>
                    <textarea class="form-control" id="other_qualities" name="other_qualities" rows="4" required>
                        {{$listing->other_qualities}}
                    </textarea>
                </div>
                @error('other_qualities')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12">
                    <label class="form-label">Explain any Special Employment Condition</label>
                    <textarea class="special" id="special" name="special_employment_condition" rows="2"  required> {{ $listing->special_employment_condition }}</textarea>
                </div>
                @error('special_employment_condition')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror

            </div>
            &nbsp;
            <div class="row">
                <div class="col-4">
                    {!! Form::label('employment_condition_cv_id', __("Employment Condition"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('employment_condition_cv_id', $conditions, $listing->employment_condition_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('employment_condition_cv_id', '<span class="badge badge-danger">:message</span>') !!}
                </div>
                <div class="col-4">
                    {!! Form::label('establishment_cv_id', __("Establishment"),['class'=>'form-label','required_asterik', 'id' => 'select-establishment']) !!}
                    {!! Form::select('establishment_cv_id', $establishments, $listing->establishment_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('establishment_cv_id', '<span class="badge badge-danger">:message</span>') !!}

                    <div class="col-4 budget" style="display: none">
                        <div class="form-label">Is there a budget for this position?</div>
                        <div class="custom-controls-stacked">
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="budget" value=1>
                                <span class="custom-control-label">Yes</span>
                            </label>
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="budget" value=0>
                                <span class="custom-control-label">No</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 employee mt-2" style="display: none">
                        <label class="form-label">Staff to be replaced</label>
                        <select name="employee_id" id="select-employee" class="form-control custom-select">
                            <option value=""  disabled selected hidden>Select Staff to be replaced </option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->fullName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-4">
                    <div class="form-label">Working Tools</div>
                    <div class="custom-controls-stacked">
                        @foreach($tools as $tool)
                            @php
                                $checked = "";
                                if(in_array($tool->id,$working_tools)){
                                    $checked = "checked";
                                }
                            @endphp
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox"  {{ $checked }} class="custom-control-input" name="tools" value="{{ $tool->id}}">
                                <span class="custom-control-label">{{ $tool->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            &nbsp;
            &nbsp;
            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-azure">Update Requisition </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</form>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $(document).on('change', '.establishment', function (){
                if($(this).val() == 23){
                    $('.budget').show()
                    $('.employee').hide()
                }
                if ($(this).val() == 22){
                    $('.employee').show()
                    $('.budget').hide()
                }
            })
        })

        $(document).ready(function (){
            let $job_description = $('#job_description').richText();
            let $education = $('#education').richText();
            let $practical = $('#practical').richText();
            let $other_qualities = $('#other_qualities').richText();
            let $special = $('#special').richText();
        })

    </script>

@endpush




