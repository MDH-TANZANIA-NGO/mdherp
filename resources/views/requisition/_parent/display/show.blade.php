@extends('layouts.app')
@section('content')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <div class="card-body"  style="background-color: #f5f5f5">
                    {{--Start - Workflow Section-----}}
                    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
                    {{--end workflow section--}}
                </div>
            </section>
        </div>
    </div>

@endsection
