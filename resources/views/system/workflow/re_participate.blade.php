@extends('layouts.main', ['title' => __("menu.system.coc.to_approve"), 'header' => $title->display_name])

@include('includes.datatable_assets')


@section('content')

    {{--@ImportUnit--}}
    <div class="row">
        @Inspector
        @include('application.includes.advanced_search')
        @endInspector

        <div id="result"> </div>

        <div class="col-sm-12" id="list-all">
            <table class="display" id="all_applications">
                <thead>
                <tr>
                    <th>@lang('label.no')</th>
                    <th>@lang('label.permit.number')</th>
                    <th>@lang('label.bl_no')</th>
                    <th>@lang('label.datatable.application')</th>
                    <th>@lang('label.type')</th>
                    <th>@lang('label.company.company')</th>
                    <th>@lang('label.date')</th>
                    <th>@lang('label.action')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    {{--@endImportUnit--}}

    {{--@CertificationUnit--}}
    {{--<div class="row">--}}
        {{--<div class="col-sm-12">--}}
            {{--<table class="display" id="premise_application">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>@lang('label.no')</th>--}}
                    {{--<th>@lang('label.datatable.application_number')</th>--}}
                    {{--<th>@lang('label.premise.name')</th>--}}
                    {{--<th>@lang('label.datatable.application_type')</th>--}}
                    {{--<th>@lang('label.premise.business_category')</th>--}}
                    {{--<th>@lang('label.date')</th>--}}
                    {{--<th>@lang('label.action')</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--@endCertificationUnit--}}

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#all_applications').DataTable({
                ajax: '{{ route('workflow.pending.previous.levels',[$wf_definition,$status]) }}',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'application_number', name: 'application_number', searchable: true },
                    { data: 'bl_number', name: 'bl_number', searchable: true},
                    { data: 'application', name: 'application', searchable: true},
                    { data: 'type', name: 'type', searchable: false },
                    { data: 'company', name: 'company', searchable: true },
                    { data: 'date', name: 'date', searchable: false },
                    { data: 'action', name: 'action', searchable: false }
                ]
            });

        });

        $(document).ready(function (){
            $("input[name = 'search']").on("keyup", function () {
                if ($.trim($(this).val()) != "") {
                    $("#list-all").hide()
                } else {
                    $("#list-all").show()
                }
            })
            $("form[name = 'advanced-search']").submit(function(event) { // catch the form's submit event
                event.preventDefault();
                $.ajax({ // create an AJAX call...
                    data: $(this).serialize(), // get the form data
                    type: $(this).attr('method'), // GET or POST
                    dataType: "html",
                    url: '{{ route('manifest.bill.search.advanced') }}', // the file to call
                    success: function(html) { // on success..
                        // $('#result').html(response); // update the DIV
                        $('#result').empty().append(html);
                        $("#list-all").hide()
                    }
                });
                $(this).refresh();
                return false; // cancel original event to prevent form submitting
            });

            $(document).on("click","#release-button", function (event) {
                var confirmation = confirm('Are you sure, you want to release this cargo');
                if(confirmation) {
                    return true;
                } else {
                    return false;
                }

            })

        });
    </script>



@endpush
