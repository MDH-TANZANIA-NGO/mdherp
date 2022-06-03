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
                                <th style ="width:10%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                            @foreach($pr_objectives AS $key => $objective)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $objective->goal }}</td>
                                    <td><a href="#" class="mr-2">Edit</a> | <a href="{{ route('hr.pr.objective.destroy',$objective) }}" onclick="if(confirm('Are you sure you want to deleted this objective')){ return true; } else { return false; }" class=" ml-2" data-objective-id>Delete</a></td>
                                </tr>

                                <!-- Modal -->
	
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