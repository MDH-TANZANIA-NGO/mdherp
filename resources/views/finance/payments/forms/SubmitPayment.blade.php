@extends('layouts.app')
@section('content')

    {!! Form::open(['route'=> ['finance.update', $payment],'method'=>'POST']) !!}
    <button type="submit"  class="btn btn-outline-info" style="margin-left: 2%;"  >Submit For Approval</button>
    {!! Form::close() !!}




@endsection
