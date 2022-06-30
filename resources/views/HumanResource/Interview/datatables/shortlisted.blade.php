 <div class="tab-pane active" id="processing">
     <div class="card-body">
         <div class="table-responsive">
             <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                     <tr>
                         <th class="wd-15p">#</th>
                         <th class="wd-15p">NAME</th>
                         <th class="wd-15p">SELECT</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($interviewApplicants as $key=>$interviewApplicant)
                        <tr>
                            <td> {{  ($key + 1)  }} </td>
                            <td> {{  $interviewApplicant->full_name  }} </td>
                            <td> <input type='checkbox' name='applicant[]' value='{{ $interviewApplicant->id }} '> </td>
                        </tr>
                    @endforeach
                </tbody>
             </table>
         </div>
     </div>
 </div>


 @push('after-scripts')
 <script>
     $(document).ready(function() {

         $("#access_processing").DataTable({
             destroy: true,
             "responsive": true,
             "autoWidth": false,
             
         });
          
     });
 </script>
 @endpush