<div class="modal fade" id="objectiveModel{{ $objective->uuid }}" tabindex="-1" role="dialog" aria-labelledby="objectiveModel{{ $objective->uuid }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['hr.pr.objective.update_challenge',$objective], 'method' => 'put']) !!}
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">OBJECTIVE</label>
                            <textarea name='goal' class="form-control" rows="5" placeholder="Add challenge" required>{{ $objective->goal }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">ACTIVITES / TASKS</label>
                            <textarea name='plan' class="form-control" rows="5" placeholder="Add challenge" required>{{ $objective->plan }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Major Accomplishment</label>
                            <textarea name='accomplishment' class="form-control" rows="5" placeholder="Add challenge" required>{{ $objective->accomplishment }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Areas of Challenge/ Opportunities for Improvement</label>
                            <textarea name='challenge' class="form-control" rows="5" placeholder="Add challenge" required>{{ $objective->challenge }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Rate/Score</label>
                            {!! Form::select('pr_rate_scale_id', $pr_rate_scales, $objective->pr_rate_scale_id,['class' => 'form-control', 'required','placeholder'=>'Select score']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>