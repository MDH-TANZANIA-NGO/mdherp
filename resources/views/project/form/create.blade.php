<!-- Row -->
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <button class="btn btn-default float-right" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"> </i>&nbsp;New Project</button>
    </div>
</div>
<!-- End Row -->


{!! Form::open(['route' => 'project.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div id="largeModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h6 class="modal-title">Create New Project</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control" name="code" placeholder="eg G6767878-f" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="eg Community 5" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description {{--<span class="form-label-small">56/100</span>--}}</label>
                                <textarea class="form-control" name="description" rows="7" placeholder="text here.." required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                    </div><input class="form-control" name="start_year" type="date" min="1997-01-01" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">End Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                    </div><input class="form-control" name="end_year"  type="date" min="1997-01-01" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fund</label>
                                <input type="number" class="form-control" name="fund" placeholder="eg G6767878-f" required>
                            </div>

                        </div>
                    </div>
                </div>

            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
{!! Form::close() !!}
