<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        <div class="tab-pane active" id="processing">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style ="">#</th>
                                <th style ="">OBJECTIVE/GOAL</th>
                                <th style ="">ACTION PLAN</th>
                                <th style ="">AREA OF CHALLENGE/ OPPORTUNITIES FOR IMPROVEMENT</th>
                                <th style ="width:10%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr_objectives AS $key => $objective)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $objective->goal }}</td>
                                    <td>{{ $objective->plan }}</td>
                                    <td>{{ $objective->challenge }}</td>
                                    <td><a href="#" class="mr-2" data-toggle="modal" data-target="#objectiveModel{{ $objective->uuid }}">Add/Update Challenge</a></td>
                                </tr>

                                <!-- Modal -->
                               
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
						                                    <label class="form-label">Areas of Challenge/ Opportunities for Improvement</label>
						                                    <textarea name='challenge' class="form-control" rows="5" placeholder="Add challenge" required>{{ $objective->challenge }}</textarea>
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
                               
                                <!-- end modal -->
	
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("#objectives").DataTable();
        });
    </script>
@endpush