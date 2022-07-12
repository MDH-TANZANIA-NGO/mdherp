<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#wait_for_interview_questions" data-toggle="tab" class="active">Waiting For Interview Questions <span class="badge badge-info">{{ $wait_interview_question_count }}</span></a></li>
                    <li><a href="#wait_for_interview_report" data-toggle="tab" class="">Waiting For Interview Report <span class="badge badge-info">{{ $wait_interview_report_count }}</span></a></li>
                    <li><a href="#saved" data-toggle="tab" class="">Saved <span class="badge badge-default">{{ $saved_count }}</span> </a></li>
                    <li><a href="#approved" data-toggle="tab" class="">Completed <span class="badge badge-success">{{ $approved_count }}</span></a></li>
                </ul>
            </div>
            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{ route('interview.create') }}"> <i class="fa fa-plus mr-2"></i>Create</a>
                </div>
            </div>
        </div>
        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="wait_for_interview_questions">
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="access_wait_for_interview_questions" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">NUMBER</th>
                                        <th class="wd-15p">JOB TITLE</th>
                                        <th class="wd-15p">TYPE</th>
                                        <th class="wd-15p">INTERVIEW DATE</th>
                                        <th class="wd-15p">APPLICANTS</th>
                                        <th class="wd-15p">CONFIRMED</th>
                                        <th class="wd-25p">CREATED AT</th>
                                        <th class="wd-25p">ACTION</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="wait_for_interview_report">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="access_wait_for_interview_report" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">NUMBER</th>
                                        <th class="wd-15p">JOB TITLE</th>
                                        <th class="wd-15p">TYPE</th>
                                        <th class="wd-15p">INTERVIEW DATE</th>
                                        <th class="wd-15p">APPLICANTS</th>
                                        <th class="wd-15p">CONFIRMED</th>
                                        <th class="wd-25p">CREATED AT</th>
                                        <th class="wd-25p">ACTION</th>
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
                                        <th class="wd-15p">NUMBER</th>
                                        <th class="wd-15p">JOB TITLE</th>
                                        <th class="wd-15p">TYPE</th>
                                        <th class="wd-15p">INTERVIEW DATE</th>
                                        <th class="wd-15p">APPLICANTS</th>
                                        <th class="wd-15p">CONFIRMED</th>
                                        <th class="wd-25p">CREATED AT</th>
                                        <th class="wd-25p">ACTION</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    $(document).ready(function() {


        $("#access_approved").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('hr.pr.datatable.access.approved') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'number',
                    name: 'hr_interviews.number',
                    searchable: true
                },
                {
                    data: 'job_title',
                    name: '',
                    searchable: true
                },
                {
                    data: 'interview_type',
                    name: '',
                    searchable: false
                },
                {
                    data: 'interview_date',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_applicants',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_confirmed',
                    name: '',
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'hr_interviews.created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });
        $("#access_wait_for_interview_questions").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('interview.datatable.access.wait_for_interview_question') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'number',
                    name: 'hr_interviews.number',
                    searchable: true
                },
                {
                    data: 'job_title',
                    name: '',
                    searchable: true
                },
                {
                    data: 'interview_type',
                    name: '',
                    searchable: false
                },
                {
                    data: 'interview_date',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_applicants',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_confirmed',
                    name: '',
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'hr_interviews.created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });
        $("#access_wait_for_interview_report").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('interview.datatable.access.wait_for_interview_report') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'number',
                    name: 'hr_interviews.number',
                    searchable: true
                },
                {
                    data: 'job_title',
                    name: '',
                    searchable: true
                },
                {
                    data: 'interview_type',
                    name: '',
                    searchable: false
                },
                {
                    data: 'interview_date',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_applicants',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_confirmed',
                    name: '',
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'hr_interviews.created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });
        $("#access_saved").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{route('interview.datatable.access.saved')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    'bSortable': false,
                    'aTargets': [0],
                    'bSearchable': false
                },
                {
                    data: 'number',
                    name: 'hr_interviews.number',
                    searchable: true
                },
                {
                    data: 'job_title',
                    name: '',
                    searchable: true
                },
                {
                    data: 'interview_type',
                    name: '',
                    searchable: false
                },
                {
                    data: 'interview_date',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_applicants',
                    name: '',
                    searchable: false
                },
                {
                    data: 'total_confirmed',
                    name: '',
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'hr_interviews.created_at',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false
                },
            ]
        });
    })
</script>
@endpush