@extends('layouts.app')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
    {!! Form::open(['route' => ['requisition.store',$requisition],'class'=>'card']) !!}
    <div class="form-group">

    </div>

    </div>

{!! Form::close() !!}
