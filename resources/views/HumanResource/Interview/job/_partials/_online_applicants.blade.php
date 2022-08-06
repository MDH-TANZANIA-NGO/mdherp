<div class="col-xl-12 col-md-12 col-md-12 col-lg-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Applicants</h3>
        </div>
        <div class="card-body">
            <table id="applicants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">FIRST NAME</th>
                        <th class="wd-15p">MIDDLE NAME</th>
                        <th class="wd-15p">LAST NAME</th>
                        <th class="wd-15p">EMAIL</th>
                        <th class="wd-15p">MOBILE NUMBER</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants AS $key => $applicant)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $applicant->first_name }}</td>
                        <td>{{ $applicant->middle_name }}</td>
                        <td>{{ $applicant->last_name }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->phone }}</td>
                        <td><a href="{{ route('hr.job.show_more',[$hire_requisition_job,$applicant->id]) }}">View More info</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>