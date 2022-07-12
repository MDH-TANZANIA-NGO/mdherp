 <?php
    $sql = "select
                hr_hire_applicants.id,
                concat_ws(
                    ' ',
                    hr_hire_applicants.first_name,
                    hr_hire_applicants.middle_name,
                    hr_hire_applicants.last_name
                ) as full_name,
                hr_interview_applicant_marks.marks
                from
                hr_hire_applicants
                join hr_interview_applicant_marks on hr_hire_applicants.id = hr_interview_applicant_marks.applicant_id  
                where hr_interview_applicant_marks.interview_id = ".$interview->id."
                order by
                hr_interview_applicant_marks.marks desc";
   $interview_reports =  \DB::select($sql);   
    ?>
 <div class="row">
     <div class="card">
         <div class="card-header">
            <div class="tags">
             <span class="tag tag-rounded" style="font-size: 14px"><b>INTERVIEW TYPE :</b> {{ $interview->interviewType->name }}</span>    
             <span class="tag tag-rounded" style="font-size: 14px"><b>INTERVIEW DATE :</b>
                     @foreach( $interview->InterviewSchedules as $interview)
                            {{ date('d-m-Y',strtotime($interview->interview_date))   }}, 
                    @endforeach   
            </span>
             <span class="tag tag-rounded" style="font-size: 14px"><b>INTERVIEW NUMBER :</b> {{ $interview->number }}</span>  
            </div>
         </div>
         <div class="card-body">
            <table class="table table-bordered table-striped">
                 <thead>
                     <th> # </th>
                     <!-- <th> Number </th> -->
                     <th> Applicant </th>
                     <th> Marks </th>
                     <th> Rank </th>
                 </thead>
                 <tbody>
                    @foreach($interview_reports  as $key=>$interview_report)
                     <tr>
                         <td>{{ $key + 1 }}</td>
                         <td>{{ $interview_report->full_name}}</td>
                         <td>{{ number_format($interview_report->marks,2) }}</td>
                         <td>{{ $key + 1 }}</td>
                         <!-- <td></td> -->
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>