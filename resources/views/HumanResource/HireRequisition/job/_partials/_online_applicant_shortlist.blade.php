<div class="col-xl-12 col-md-12 col-md-12 col-lg-12 mt-3">
<form id="applicant-form" action="{{ route('job_applicant_shortlister.shortlist',$hire_requisition_job) }}" method="POST">
        @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Applicants</h3>
            <div class="card-options ">
                {!! Form::submit('Click here to submit shortlisted Applicant for approvals',['class' => 'btn btn-primary', 'id' => 'submit_form']) !!}
            </div>
        </div>
        <div class="card-body">
            <table id="applicants_datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">FIRST NAME</th>
                        <th class="wd-15p">MIDDLE NAME</th>
                        <th class="wd-15p">LAST NAME</th>
                        <th class="wd-15p">EMAIL</th>
                        <th class="wd-15p">MOBILE NUMBER</th>
                        <th class="wd-15p">STATUS</th>
                        <th class="wd-25p">ACTION</th>
                        <th><input name="select_all" value="1" id="select-all-shortlited" type="checkbox" /></th>
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
                        <td>{{ is_shortlisted($applicant->id, $hire_requisition_job->id) ? 'Not Shortlisted' : 'Shortlisted' }}</td>
                        <td><a href="{{ route('hr.job.show_more',[$hire_requisition_job,$applicant->id]) }}">View More info</td>
                        <td><input type="checkbox" name="hr_applicants[]" value="{{ $applicant->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
</div>

@push('after-scripts')
<script>
    $(document).ready(function() {
        var table = $("#applicants_datatable").DataTable();
        // Handle click on "Select all" control
        $('#select-all-shortlited').on('click', function() {
            // Check/uncheck all checkboxes in the table
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#applicants_datatable tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#select-all-shortlited').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control 
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });

        $('#applicant-form').on('submit', function(e) {
            var form = this;

            // Iterate over all checkboxes in the table
            table.$('input[type="checkbox"]').each(function() {
                // If checkbox doesn't exist in DOM
                if (!$.contains(document, this)) {
                    // If checkbox is checked
                    if (this.checked) {
                        // Create a hidden element 
                        $(form).append(
                            $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', this.name)
                            .val(this.value)
                        );
                    }
                }
            });
        });
    })
</script>
@endpush