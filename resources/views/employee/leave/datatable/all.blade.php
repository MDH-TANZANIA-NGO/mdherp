
        <div class=" tab-menu-heading card-header" style="background-color: rgb(241,242,243)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#processing" class="active" data-toggle="tab">Onprocess <span class="badge badge-warning"></span></a></li>
                    <li><a href="#rejected" data-toggle="tab" class="">Returned <span class="badge badge-danger"></span></a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Approved <span class="badge badge-success"></span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default"></span> </a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('account.leave.create') }}"> <i class="fa fa-plus mr-2"></i>Apply Leave</a>
                </div>
            </div>

        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="processing">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Type</th>
                                    <th class="wd-25p">Start Date</th>
                                    <th class="wd-25p">End Date</th>
                                    <th class="wd-25p">Comment</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="tab-pane" id="saved">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_saved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Type</th>
                                    <th class="wd-25p">Start Date</th>

                                    <th class="wd-25p">End Date</th>
                                    <th class="wd-25p">Comment</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="approved">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_approved" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Type</th>
                                    <th class="wd-25p">Start Date</th>

                                    <th class="wd-25p">End Date</th>
                                    <th class="wd-25p">Comment</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="rejected">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_rejected" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Type</th>
                                    <th class="wd-25p">Start Date</th>

                                    <th class="wd-25p">End Date</th>
                                    <th class="wd-25p">Comment</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>







