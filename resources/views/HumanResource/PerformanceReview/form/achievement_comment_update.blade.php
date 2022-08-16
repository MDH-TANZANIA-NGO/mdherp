@if($pr_report->parent->supervisor_id == access()->id())
{!! Form::open(['route' => ['hr.pr.achievement_comment.update', $pr_report->achievementComment],'method' => 'put']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <div class="form-group">
            <label class="form-label">Level of achievement on the expected plan of 3 months<br>
            </label>
			<textarea name='comment' class="form-control" autofocus rows="5">{{ $pr_report->achievementComment->comment }}</textarea>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <input type="submit" value="Update Comment" class="btn btn-primary">
    </div>
</div>
{!! Form::close() !!}
@endif