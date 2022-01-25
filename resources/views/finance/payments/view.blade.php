@extends('layouts.app')
@section('content')

    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
@endsection
