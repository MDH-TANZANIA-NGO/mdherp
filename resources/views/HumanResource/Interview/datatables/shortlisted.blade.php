 <div class="tab-pane active" id="processing">
     <div class="card-body">
         <div class="table-responsive">
             <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                     <tr>
                         <th class="wd-15p">#</th>
                         <th class="wd-15p">NAME</th>
                       
                         <th class="wd-15p">SHORTLISTED ON</th>
                         <th class="wd-15p">SELECT</th>
                     </tr>
                 </thead>
             </table>
         </div>
     </div>
 </div>


 @push('after-scripts')
 <script>
     $(document).ready(function() {

         $("#access_processing").DataTable({
             destroy: true,
             retrieve: true,
             "responsive": true,
             "autoWidth": false,
             ajax: "{{ route('interview.datatable.access.shortlisted') }}",
             columns: [{
                     data: 'DT_RowIndex',
                     name: 'DT_RowIndex',
                     'bSortable': false,
                     'aTargets': [0],
                     'bSearchable': false
                 },
                 {
                     data: 'full_name',
                     name: 'hr_hire_applicants.first_name',
                     searchable: true
                 },
                 {
                     data: 'created_at',
                     name: 'hr_hire_requisition_job_applicants.created_at',
                     searchable: true
                 },
                 {
                     data: 'select',
                     name: 'hr_hire_applicants.id',
                     searchable: true
                 }
             ]
         });
          
     });
 </script>
 @endpush