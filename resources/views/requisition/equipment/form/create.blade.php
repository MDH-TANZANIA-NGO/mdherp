{!! Form::open(['route' => 'equipment.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-3">
                    <label for="equipment_type" class="form-label">Equipment Category</label>
                    {!! Form::select('equipment_type',$equipment_type_pluck,null,['class' => 'form-control select2-show-search', 'required', 'placeholder' => 'Select']) !!}
                    @error('equipment_type')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label">Title</label>
                    {!! Form::text('title',null,['class' => 'form-control', 'required']) !!}
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="price_from" class="form-label">Price Form</label>
                    {!! Form::number('price_from',null,['class' => 'form-control', 'required']) !!}
                    @error('price_from')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label class="form-label">Price To</label>
                    {!! Form::number('price_to',null,['class' => 'form-control', 'required']) !!}
                    @error('price_to')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Specifications</label>
                    {!! Form::textarea('specs',null,['class' => 'form-control textarea', 'required']) !!}
                    @error('specs')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

            </div>

            <div class="row mt-4">

                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-azure">Register</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}





