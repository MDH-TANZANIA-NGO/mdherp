 <div class="tab-pane active">
     <div class="card-body">
         <div class="table-responsive">
             <table id="schedule_interview" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                     <tr>
                         <th class="wd-15p">#</th>
                         <th class="wd-15p">NAME</th>

                     </tr>
                 </thead>
                 <tbody>
                    @foreach($interviewApplicants as $key=>$applicants)
                        <tr>
                            <td>{{($key+1)}}</td>
                            <td>{{ $applicants->full_name}}</td>
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

         $("#schedule_interview").DataTable({
             destroy: true,
             retrieve: true,
             "responsive": true,
             "autoWidth": false,
         });
          
     });
 </script>
 @endpush