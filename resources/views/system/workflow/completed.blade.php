@extends('layouts.main', ['title' => __("workflow.completed"), 'header' => __("workflow.completed")])

@include('includes.datatable_assets')

@push('after-styles')
    {{--{{ Html::style(asset_url() . "/nextbyte/plugins/select2/css/select2.min.css") }}--}}
    <style>
        .custom_filter:after {
            background-color: #F5F5F5;
            border: 1px solid #DDDDDD;
            border-radius: 4px 0 4px 0;
            color: #3c5ba4;
            content: "{!! __('label.custom_filter') !!}";
            /* font-size: 12px;
            font-weight: bold; */
            left: -1px;
            padding: 3px 7px;
            position: absolute;
            top: -1px;
        }

        .custom_filter {
            background-color: #FFFFFF;
            border: 1px solid #DDDDDD;
            border-radius: 4px 4px 4px 4px;
            margin: 5px 0px;
            padding: 39px 19px 14px;
            position: relative;
        }

    </style>
@endpush

@section('content')
    <div class="row">


        <div class="col">

        {{--<div class="row">--}}

        <!-- Put the page specifically for this page here -->
            @include("system/workflow/count_summary")

            {{--<!-- Put the page specifically for this page here -->--}}
            @include("system/workflow/pending_filter")

            @include("system/workflow/pending_table")

            <br>


            {{--</div>--}}

        </div>


    </div>


@endsection

@push('after-scripts')
    <!-- Custom javascript files for this page -->
    @include("system/workflow/pending_script")
@endpush
