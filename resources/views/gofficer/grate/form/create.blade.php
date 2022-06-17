{!! Form::open(['route' => 'g_rate.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="float-left col-10">

                    {!! Form::number('amount',null,['class' => 'form-control', 'required']) !!}
</div>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror

<button type="submit" class="btn btn-azure">Register Amount</button>

{!! Form::close() !!}





