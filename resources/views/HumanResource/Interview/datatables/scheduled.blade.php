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
                    <?php
                        $scheduled_applicants = \DB::table('hr_interview_applicants')
                                                ->join('hr_hire_applicants','hr_hire_applicants.id','hr_interview_applicants.applicant_id')
                                                ->where('interview_schedule_id',$schedule)->get()
                    ?>
                    @foreach($scheduled_applicants as $key=>$scheduled_applicant)
                        <tr>
                            <td>{{($key+1)}}</td>
                            <td>{{ $scheduled_applicant->first_name." ".$scheduled_applicant->last_name}}</td>
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