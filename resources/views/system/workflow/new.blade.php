@extends('layouts.app', ['title' => 'icap Attendance System', 'header' => 'Home'])
@push('nav-head')
    @include('includes.navigation.workflow.new_nav')
@endpush
{{--@include('includes.scripts.datatable')--}}
@section('content')

                @include("system/workflow/count_summary")
            <!-- start: page -->
            <div class="row">

                <div class="col">
                    <section class="card">
                        <div class="card-body">
                            @include("system/workflow/pending_filter")
                            @include("system/workflow/pending_table")
                        </div>
                    </section>
                </div>

            </div>

@endsection

@push('after-scripts')
    <!-- Custom javascript files for this page -->
    @include("system/workflow/pending_script")
@endpush
