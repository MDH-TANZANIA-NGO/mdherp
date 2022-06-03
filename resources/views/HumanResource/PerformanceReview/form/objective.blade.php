{!! Form::open(['route' => ['hr.pr.objective.store',$pr_report]]) !!}
<div class="row ml-2">
    <div class="col-md-11 col-sm-11 col-lg-11 col-xl-11">
        <div class="form-group">
			<label class="form-label">Objective</label>
			<textarea class="form-control" name="goal" placeholder="Type one objective" required></textarea>
        </div>
    </div>
    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1">
        <div class="form-group">
			<label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</div>
{!! Form::close() !!}