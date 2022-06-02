<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">PROBATIONARY APPRAISAL FORM</h3>
		</div>
        <div class="card-body">
            {!! Form::open(['route' => 'hr.pr.probation_store']) !!}
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">3 Monthly Appraisal due on</label>
						<input type="text" value="{{ access()->user()->employed_date }}" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Completed on</label>
						<input type="text" value="{{ access()->user()->three_month_probation }}" class="form-control" placeholder="" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Initiate</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
