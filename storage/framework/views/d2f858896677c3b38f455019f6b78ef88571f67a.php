<div id="workflow-content">

</div>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(function() {


            // initTable("completed_workflow");
            var $current_wf_track_id = '<?php echo $current_wf_track->id; ?>';

            // // $("#modal-content").empty();
            load_workflow_modal($current_wf_track_id);

            function load_workflow_modal($wf_track_id) {
                $.get("<?php echo route('workflow.workflow_content'); ?>", {'wf_track_id': $current_wf_track_id}, function (data) {
                    $("#workflow-content").empty();
                    $(data).prependTo("#workflow-content");
                }, "html").done(function () {
                    /* $(".search-select").select2({}); */
                    let $body = $("body");
                    $body.off("change", ".workflow_status_select").on("change", ".workflow_status_select", function (e) {
                        let $status = $(this).val();
                        let $wf_track_id = $(this).attr("data-track_id");
                        let $next_level_designation = $(".next_level_designation");
                        let $reject_to_level = $(".reject_to_level");
                        let $reject_to_level_select = $(".reject_to_level_select");
                        let $selective = $(".selective");
                        let $selective_select = $(".selective_select");
                        let $next_level_designation_content = $(".next_level_designation_content");
                        let $assign_to_level = $(".assign_to_level");
                        // $assign_to_level.hide();
                        switch($status) {
                            case '1':
                                // alert(1);
                                $assign_to_level.show();
                            /*case '4':*/
                                if ($status === "1") {
                                    $selective.show();
                                    $selective_select.prop( "disabled", false );

                                } else {
                                    $selective.hide();
                                    $selective_select.prop( "disabled", true );
                                }
                                $reject_to_level.hide();
                                $.post( base_url + "/workflow/next_level_designation/" + $wf_track_id + "/" + $status , {}, function( $data ) {
                                    /*alert($data.skip);*/
                                    if ($data.next_level_designation !== "") {
                                        $next_level_designation.show();
                                        $next_level_designation_content.empty();
                                        $next_level_designation_content.html( $data.next_level_designation );
                                    } else {
                                        $next_level_designation.hide();
                                    }
                                }, "json").done(function($data) {});
                                $( ".assign_to_level_select").prop( "disabled", false );
                                break;
                            case '2':
                                $selective.hide();
                                $selective_select.prop( "disabled", true );
                                $assign_to_level.hide();
                                $next_level_designation.hide();
                                $reject_to_level.show();
                                $reject_to_level_select.prop( "disabled", false );
                                $( ".assign_to_level_select").prop( "disabled", true );
                                break;
                            case '4':
                                $assign_to_level.hide();
                                $reject_to_level.hide();
                                $( ".reject_to_level_select").prop( "disabled", true );
                                $( ".assign_to_level_select").prop( "disabled", true );
                                break;
                            default:
                                $selective.hide();
                                $selective_select.prop( "disabled", true );
                                $next_level_designation.hide();
                                $reject_to_level.hide();
                                $reject_to_level_select.prop( "disabled", true );
                                break;
                        }
                    });
                    $('.workflow_status_select').trigger('change');
                    autosize($("textarea.autosize"));

                }).fail(function () {

                }).always(function () {

                });
            }

            let $body = $("body");
            $body.off("submit", "#approval_form").on("submit", "#approval_form", function () {
                $body.find("#submit_approval_modal").hide();
                $body.find("#form_status").show();
                $body.find("#form_status").text("Please wait...");
            })

        });


    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/william/Code/mdherp/resources/views/includes/workflow/workflow_track.blade.php ENDPATH**/ ?>