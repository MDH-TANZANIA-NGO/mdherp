
<div class="row mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">SHORTLISTED PENDING FOR INTEVIEW INVITATION</h3>
            <h3 class="card-title">ShortList Number </h3>
        </div>
        <div class="card-body">

            @csrf
            <input type="hidden" value="{{ $interview->id }}" name="interview_id">
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
                                    <td> {{ ($key + 1)  }} </td>
                                    <td> {{ $interviewApplicant->first_name." ".$interviewApplicant->middle_name." ".$interviewApplicant->last_name  }} </td>
                                    <td> <input type='checkbox' name='applicant[]' value='{{ $interviewApplicant->id }} '> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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