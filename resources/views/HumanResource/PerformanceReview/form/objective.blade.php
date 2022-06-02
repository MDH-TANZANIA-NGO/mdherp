{!! Form::open(['route' => ['hr.pr.objective.store',$pr_report]]) !!}
<div class="row">
    <div class="col-md-10 col-sm-10 col-lg-10 col-xl-10">
        <div class="form-group">
			<label class="form-label">Objective</label>
			<input type="text" class="form-control" name="goal" placeholder="Type one objective" required/>
        </div>
    </div>
    <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
        <div class="form-group">
			<label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</div>
{!! Form::close() !!}