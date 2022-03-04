@extends('layouts.app')
@section('content')
    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])



    <br>
    @include('programactivity.display.generalSumarry')

    @include('programactivity.datatable.participants.all')

    @include('programactivity.datatable.items.all')
    @endsection
