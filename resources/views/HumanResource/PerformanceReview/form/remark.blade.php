<?php $remark_directive = pr_remark_driver($pr_report, $workflows) ?>
{!! Form::open(['route' => ['hr.pr.remark.store', $pr_report],'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <div class="form-group">
            <label class="form-label"></label>
            <input type="hidden" name='pr_remarks_cv_id' value="">
			<textarea name='remarks' class="form-control" autofocus rows="5" required></textarea>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <input type="submit" value="Submit Comment" class="btn btn-primary">
    </div>
</div>
{!! Form::close() !!}