{!! Form::open(['route' => 'output_unit.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">

        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Register Output Unit</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-6 mx-auto">
                    {{-- <label class="form-label">Output unit Title</label> --}}
                    {!! Form::text('title',null,['class' => 'form-control','placeholder' => 'Enter Output unit title', 'required']) !!}
                    @error('title')
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





