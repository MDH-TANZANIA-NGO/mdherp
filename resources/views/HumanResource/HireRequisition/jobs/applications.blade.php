@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Current Jobs</h3>
    </div>
    <div class="card-body">
        <table id="applications" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="wd-15p">#</th>
                    <th class="wd-15p">TITLE</th>
                    <th class="wd-15p">POSTS</th>
                    <th class="wd-15p">EDUCATION LEVEL</th>
                    <th class="wd-25p">CREATED AT</th>
                    <th class="wd-25p">ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {

        $("#applications").DataTable({
            destroy: true, retrieve: true, "responsive": true, "autoWidth": false,
            ajax: "{{ route('hr.job.datatable.application') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', 'bSortable': false, 'aTargets': [0], 'bSearchable': false },
                { data: 'job_title', name: 'designations.name', searchable: true },
                { data: 'empoyees_required', name: 'hr_hire_requisitions_jobs.empoyees_required', searchable: true },
                { data: 'education_level', name: 'hr_hire_requisitions_jobs.education_level', searchable: true },
                { data: 'created_at', name: 'hr_hire_requisitions_jobs.created_at', searchable: true },
                { data: 'action', name: 'action', searchable: false },
            ]
        });

    })
</script>
@endpush