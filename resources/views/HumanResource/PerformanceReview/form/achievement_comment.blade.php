@if($pr_report->parent->supervisor_id == access()->id() && $pr_report->achievementComment == null)
{!! Form::open(['route' => ['hr.pr.achievement_comment.store', $pr_report],'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <div class="form-group">
            <label class="form-label">Level of achievement on the expected plan of 3 months<br>
            </label>
			<textarea name='comment' class="form-control" autofocus rows="5"></textarea>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <input type="submit" value="Submit Comment" class="btn btn-primary">
    </div>
</div>
{!! Form::close() !!}
@else
@include('HumanResource.PerformanceReview.form.achievement_comment_update')
@endif