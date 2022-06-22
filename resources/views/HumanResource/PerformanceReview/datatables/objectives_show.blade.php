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
                                <th>ACTION PLAN</th>
                                @if($can_edit_resource)<th style ="width:10%">ACTION</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr_objectives AS $key => $objective)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $objective->goal }}</td>
                                    <td>{{ $objective->plan }}</td>
                                    @if($can_edit_resource == false)<td><a href="#" class="mr-2" data-toggle="modal" data-target="#objectiveModel{{ $objective->uuid }}">Edit</a> | <a href="{{ route('hr.pr.objective.destroy',$objective) }}" onclick="if(confirm('Are you sure you want to deleted this objective')){ return true; } else { return false; }" class=" ml-2" data-objective-id>Delete</a></td>@endif
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
                                            {!! Form::open(['route' => ['hr.pr.objective.update',$objective], 'method' => 'put']) !!}
                                            <div class="modal-body">
                                           
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                                                        <div class="form-group">
						                                    <label class="form-label">Objective/Goal</label>
						                                    <input type="text" name='goal' value="{{ $objective->goal }}" class="form-control" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                                                        <div class="form-group">
						                                    <label class="form-label">Action Plan</label>
						                                    <textarea name='plan' class="form-control" placeholder="" required>{{ $objective->plan }}</textarea>
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