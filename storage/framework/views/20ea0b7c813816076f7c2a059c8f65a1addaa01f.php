<div class="row">

<div class="col-md-12">

    <table class="table table-striped table-bordered" id="pending_datatable" style="background-color: #f5f5f5">
        <tbody>
        <tr style="background-color: rgb(238, 241, 248);">
            <th>TITLE</th>
            <th>LEVEL</th>
            <th>INSTRUCTION</th>
            <th>COMMENTS</th>
            <th>AGING DAY(S)</th>

        </tr>
        <?php $__currentLoopData = $pending_tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending_track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr style="background-color: #FFFFFF">
                <td ><?php echo $pending_track->username_formatted; ?></td>
                

                <td ><?php echo $pending_track->level_with_narration_budge; ?></td>
                <th><?php echo $pending_track->wfDefinition->description; ?></th>


                <td ><?php echo $pending_track->comments; ?></td>
                <th><?php echo $pending_track->getAgingDays(); ?></th>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </tbody>
    </table>

</div>


</div>
<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/includes/workflow/pending_wf_tracks.blade.php ENDPATH**/ ?>