{!! Form::open(['route' => ['output_unit.update', $output_unit], 'method' => 'put',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-3 mx-auto">
                    <label class="form-label">Title</label>
                    {!! Form::text('title',$output_unit->title,['class' => 'form-control', 'required']) !!}
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-4">

                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-azure">Update</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}





