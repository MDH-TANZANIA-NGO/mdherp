<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12" id="overall_holder">
		<div class="card">
        	<div class="card-header"><h3 class="card-title">REMARKS</h3>
        </div>
        	<div class="card-body">
                <table class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Comment</th>
                        <th>Commented By</th>
                        <th>Commented AS</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($pr_report->remarks AS $key => $remark)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $remark->remarks }}</td>
                                <td>{{ $remark->user->fullname }}</td>
                                <td>{{ $remark->remarkTitle }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>