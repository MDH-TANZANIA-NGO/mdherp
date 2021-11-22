{{--{{ Html::script(asset_url(). "/nextbyte/plugins/select2/js/select2.min.js") }}--}}
<script>
    $(function() {
        $(".wf-module-select").select2();
        $(".search-select").select2();
        var $wf_module_group_id = 1;

        @if ($state == "all" Or $state == "attended")
        $("#status").on("change", function () {
            var $status = $(this).val();
            switch($status) {
                case '3':
                    /* Selected to choose User Assigned */
                    $(".user_select").show();
                    break;
                default:
                    $(".user_select").hide();
                    break;
            }
        });
        $('#status').trigger('change');
        @endif

        {{--$(".wf-module-select").on("change", function () {--}}
        {{--get_module_group($(this).val()).done(function (data) {--}}
        {{--var $category = data.wf_module_group_id;--}}
        {{--$wf_module_group_id = $category;--}}
        {{--$('input[name=search]').val("");--}}
        {{--var $unregistered_modules = {{ json_encode($unregistered_modules) }};--}}
        {{--switch($category) {--}}
        {{--case 1:--}}
        {{--case 2:--}}

        {{--break;--}}
        {{--default:--}}
        {{--reset_filter();--}}
        {{--break;--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}

        $('.wf-module-select').trigger('change');

        $('.module_summary').on('click', function(e) {
            var module_id = $(this).attr('id');
            $('#module').val(module_id).change();
        });

        $('.application-category-select').trigger('change');
        $('.application_category').on('click', function(e) {
            var application_category_id = $(this).attr('id');
            $('#application_category').val(application_category_id).change();
        });


        var oTable = $('#pending-workflow-table').DataTable({
            //dom : 'Bfrtip',
            buttons : ['reload', 'colvis'],
            initComplete : function () {
                oTable.buttons().container()
                    .insertBefore('#pending-workflow-table');
            },
            // processing: true,
            serverSide: false,
            info : true,
            ajax: {
                url: "{!! route("workflow.pending.get") !!}",
                data: function (d) {
                    d.wf_module_id = $('select[name=wf_module_id]').val();
                    d.wf_module_group_id = $wf_module_group_id;
                    d.state = '{!! $state !!}';
                    d.application_category_id = $('[name=application_category_id]').val();
                }
            },

            columns: [
                // {data: 'checkbox', name: 'checkbox', searchable: false, orderable: false},
                {data: 'resource_name', name: 'resource_name', searchable: true, orderable: false},
                {data: 'receive_date_formatted', name: 'receive_date'},
                {data: 'level', name: 'level'},
                {data: 'description', name: 'wf_definitions.description'},
                {data: 'module', name: 'wf_modules.name'},
                {data: 'status', name: 'assigned', searchable: false},
                {data: 'resource_id', name: 'resource_id', visible: false, searchable: false, orderable: false},
                {data: 'module_group_id', name: 'wf_module_groups.id', visible: false, searchable: false, orderable: false},
                {data: 'module_id', name: 'wf_modules.id', visible: false, searchable: false, orderable: false},
                // {data: 'status', name: 'status', searchable: false},
            ],

            'rowCallback': function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $(nRow).click(function() {
                    switch(aData['module_group_id']) {
                        case 1: /*TAF*/
                            window.open(base_url + "/tafs/" + aData['resource_uuid'] + '/overview' , "_blank");
                            break;
                        case 2: /*TBER*/
                            window.open(base_url + "/tbers/" + aData['resource_uuid'] + '/overview' , "_blank");
                            break;
                        case 4: /*COV CEC*/
                            window.open(base_url + "/cov-and-cec-payment-module/" + aData['resource_uuid'] + '/view' ,
                                "_blank");
                            break;
                        case 5: /*LEAVE*/
                            window.open(base_url + "/leaves/" + aData['resource_uuid'] + '/view' , "_blank");
                            break;
                        case 6: /*TIMESHEET*/
                            window.open(base_url + "/timesheets/" + aData['resource_uuid'] + '/view' , "_blank");
                            break;
                        case 7: /*PURCHASE REQUISITION*/
                            window.open(base_url + "/procurements/purchase-requisitions/" + aData['resource_uuid'] + '/show' , "_blank");
                            break;
                        default:
                            break;
                    }
                }).hover(function() {
                    $(this).css('cursor', 'alias');
                }, function() {
                    $(this).css('cursor', 'auto');
                });
            }
        });
        $('#search-form').on('submit', function(e) {
            /*alert($wf_module_group_id);*/
            oTable.draw();
            e.preventDefault();
        });
    });
    function get_module_group($module) {
        return $.post("{{ url('/') }}/getModuleGroup", {'module': $module}, function ($data) {}, "json");
    }
    function reset_filter() {
        $(".notification_select").hide();
        $(".employer_select").hide();
        $(".receipt_select").hide();
        $(".payroll_select").hide();
    }
    function employer_filter() {
        reset_filter();
        $(".notification_select").hide();
        $(".employer_select").show();

    }
    function notification_filter() {
        reset_filter();
        $(".notification_select").show();
    }
    function receipt_filter() {
        reset_filter();
        $(".receipt_select").show();
    }

    function payroll_filter() {
        reset_filter();
        $(".payroll_select").show();
        $("#dependent_div").hide();
        $("#pensioner_div").hide();
        $("#dependent_id").val(0).change();
        $("#pensioner_id").val(0).change();
        $("#member_type_id").val(0).change();
    }

    // function trigger_module_click(){
    //     var $module_id = $('')
    // }


</script>
