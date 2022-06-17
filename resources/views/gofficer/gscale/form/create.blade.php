{!! Form::open(['route' => 'g_scale.store', 'method' => 'post',]) !!}
                    <div class="float-left col-10">
                    {!! Form::text('title',null,['class' => 'form-control', 'required','placeholder'=>'Enter Job Title Here...']) !!}
                    </div>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
    <button type="submit" class="btn btn-azure">Add Title</button>

{!! Form::close() !!}





