<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">PROBATIONARY APPRAISAL FORM</h3>
		</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Start Date</label>
						<input type="text" value="{{ access()->user()->employed_date }}" class="form-control" name="example-text-input" placeholder="Name" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function (){
            // let $description_editor = $("#description_editor").richText();
        });
    </script>
@endpush
