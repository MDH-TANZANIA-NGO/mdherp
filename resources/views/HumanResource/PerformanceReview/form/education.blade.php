@if($pr_report->user_id == access()->id() && $pr_report->education()->count() == 0)
{!! Form::open(['route' => ['hr.pr.education.store', $pr_report],'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
        <div class="form-group">
            <span style='font-style: normal'>
            Educational opportunities are needed for the employee?
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