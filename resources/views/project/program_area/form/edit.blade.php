{!! Form::open(['route' => ['project.update',$project], 'method' => 'put',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-3">
                    {!! Form::label('code', __("label.code"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('code', $project->code, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('code', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', $project->title, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('start_year', __("label.start_year"),['class'=>'form-label','required_asterik']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" value="{{ $project->start_year }}" name="start_year" type="date" min="1997-01-01" required>
                    </div>
                    {!! $errors->first('start_year', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('end_year', __("label.end_year"),['class'=>'form-label','required_asterik']) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" value="{{ $project->end_year }}" name="end_year"  type="date" min="1997-01-01" required>
                    </div>
                    {!! $errors->first('end_year', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            <div class="row">
                <div class="col-3">
                    {!! Form::label('type', __("label.type"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('type', $types, $project->project_type_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('type', '<span class="badge badge-danger">:message</span>') !!}
                </div>
                <div class="col-6 hidden" id="region_holder">
                    <label class="form-label">Region(s)</label>
                    {!! Form::select('regions[]', $regions, $project_region, ['class' =>'form-control select2 custom-select', 'multiple','disabled','required']) !!}
                </div>
                @error('regions')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', $project->description, ['class' => 'form-control', 'required','row'=>'2']) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-azure" style="margin-top: 5px; margin-left: 10px">Update Project </button>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}

@push('after-scripts')
    <script>
        $(document).ready(function () {
            let $type_input = $("select[name='type']");
            let $region_holder = $("#region_holder");
            let $region_input = $("select[name='regions[]']");

            $region_holder.hide();

            projectType();

            $type_input.change(function (event){
                event.preventDefault();
                let $value = $(this).val();
                if($value === "{{ config('mdh.project.with_region') }}"){
                    $region_holder.show()
                    $region_input.attr('disabled',false);
                }else{
                    $region_holder.hide();
                    $region_input.attr('disabled',true);
                }
            });

            function projectType()
            {
                if($type_input.val() === "{{ config('mdh.project.with_region') }}"){
                    $region_holder.show()
                    $region_input.attr('disabled',false);
                }else{

                }
            }
        });
    </script>
@endpush




