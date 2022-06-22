@if($pr_report->user_id == access()->id() && $pr_report->skill()->count() == 0)
{!! Form::open(['route' => ['hr.pr.skill.store', $pr_report],'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <div class="form-group">
            <label class="form-label">SKILLS REQUIRED<br>
            <span style='font-style: normal'>
            Job-related areas or skills I need to concentrate on acquiring or refining to develop professionally and/or improve performance during the coming year
            </span>
            </label>
			<textarea name='comment' class="form-control" autofocus rows="5"></textarea>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <input type="submit" value="Submit Comment" class="btn btn-primary">
    </div>
</div>
{!! Form::close() !!}
@endif