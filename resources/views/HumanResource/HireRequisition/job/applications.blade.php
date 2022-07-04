@extends('layouts.app')

@section('content')
<div class="card">
<form id="application-form" action="{{ route('job_shortlister.store') }}" method="POST">
@csrf
    <div class="card-header">
        <h3 class="card-title">List of Current Jobs</h3>
        <div class="card-options ">
            {!! Form::submit('Click here to add shortlisters',['class' => 'btn btn-primary', 'id' => 'submit_form']) !!}
        </div>
    </div>
    <div class="card-body">
        <table id="applications" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="wd-15p">#</th>
                    <th class="wd-15p">TITLE</th>
                    <th class="wd-15p">CONTRACT TYPE</th>
                    <th class="wd-15p">POSTS</th>
                    <th class="wd-15p">EDUCATION LEVEL</th>
                    <th class="wd-25p">CREATED AT</th>
                    <th class="wd-25p">ACTION</th>
                    <th><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
                </tr>
            </thead>
        </table>
    </div>
 {!! Form::close() !!}
</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {

        var table = $("#applications").DataTable({
            destroy: true,
            retrieve: true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('hr.job.datatable.application') }}",
            'columnDefs': [{
                'targets': 7,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="hr_hire_requisitions_job_ids[]" value="' +full.id+ '">';
                }
            }],
            'order': [1, 'asc'],
            columns: [
                { data: 'DT_RowIndex',name: 'DT_RowIndex','bSortable': false,'aTargets': [0],'bSearchable': false},
                { data: 'job_title',name: 'designations.name',searchable: true},
                { data: 'contract_type',name: 'code_values.name',searchable: true},
                { data: 'empoyees_required',name: 'hr_hire_requisitions_jobs.empoyees_required',searchable: true},
                { data: 'education_level',name: 'code_values.name',searchable: true},
                { data: 'created_at',name: 'hr_hire_requisitions_jobs.created_at',searchable: true},
                { data: 'action',name: 'action',searchable: false},
            ]
        });

        // Handle click on "Select all" control
        $('#select-all').on('click', function() {
            // Check/uncheck all checkboxes in the table
            var rows = table.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#applications tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control 
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });

        $('#application-form').on('submit', function(e) {
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