<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        <div class="tab-pane active" id="processing">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">OBJECTIVE/GOAL</th>
                                <th class="wd-15p">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr_objectives AS $key => $objective)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $objective->goal }}</td>
                                    <td><a href="" class="btn btn-primary">Edit</a></td>
                                </tr>
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