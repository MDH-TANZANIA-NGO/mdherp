<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">INTERVIEW QUESTION </h3>
		</div>
        <div class="card-body">
            {!! Form::open(['route' => 'interview.question.store']) !!}
            <div class="row">
                <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
						<label class="form-label">Question </label>
 
                </div>
                <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                     <textarea type="text" name="question" class="form-control" placeholder="enter interview question here ..."></textarea>
                </div>
               
                <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
            <div class="row mt-3"> 
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr><th> Qno</th><th>Question</th></tr>
                        </thead>
                        <tbody>
                             
                        </tbody>
                    </table>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
