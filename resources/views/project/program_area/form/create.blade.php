{!! Form::open(['route' => 'program_area.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    {!! Form::label('project', __("label.project"),['class'=>'form-label','required_asterik']) !!}
               {{-- {!! Form::select('project', $projects, null,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!} --}}
                    {!! Form::select('projects[]', $projects, [], ['class' =>'form-control select2 custom-select' , 'multiple','required']) !!}
                    {!! $errors->first('project', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;

            <div class="row">

                <div class="col-12">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control','placeholder' => 'Enter program area title', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder' => 'Enter program area descriptions', 'required','rows'=>2]) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            &nbsp;

            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">

                <button type="submit" class="btn btn-azure">Create Program Area </button>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}
