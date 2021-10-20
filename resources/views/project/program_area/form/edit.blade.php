{!! Form::open(['route' => ['program_area.update', $program_area], 'method' => 'PUT',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-6">
                    {!! Form::label('project', __("label.project"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('projects[]', $projects, $program_area_projects, ['class' =>'form-control select2 custom-select', 'multiple','required']) !!}
                    {!! $errors->first('project', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', $program_area->title, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', $program_area->description, ['class' => 'form-control', 'required','row'=>'2']) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-azure" style="margin-top: 5px; margin-left: 10px">Store new Program Area </button>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}
