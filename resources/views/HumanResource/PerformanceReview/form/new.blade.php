<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">PERFORMANCE APPRAISAL FORM</h3>
		</div>
        <div class="card-body">
            {!! Form::open(['route' => 'hr.pr.store']) !!}
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Start Date</label>
						<input type="date" name="from_at" value="{{ old('from_at') }}" class="form-control" require>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Completed on</label>
						<input type="date" name="to_at" value="{{ old('to_at') }}" class="form-control" require>
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
