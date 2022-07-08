 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">RECOMMENDATION</h3>
             @if(!isset($show))
                <div class="card-options">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add To Recommendation</button>
                </div>
             @endif
         </div>
         <div class="card-body">
             <table class="table table-bordered table-striped">
                 <thead>
                     <th> # </th>
                     <th> Name </th>
                     <th> Email </th>
                     @if(!isset($show))
                     <th> Action </th>
                     @endif
                 </thead>
                 <tbody>
                    @foreach($recommended_applicants as $key=>$recommended_applicant)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> {{ $recommended_applicant->full_name }}</td>
                            <td> {{ $recommended_applicant->email }}</td>
                            @if(!isset($show))
                             <td> <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('interview.report.remove_recommended',$recommended_applicant->id)}}">Remove</a></td>
                            @endif
                        </tr>
                    @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add Applicant To Recommendation List</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
             {!! Form::open(['route' => 'interview.report.recommend']) !!}
                @method('POST')
                 <div class="form-group">
                     <label class="form-label">Applicant</label>
                     {!! Form::select('applicant_id',$applicants,null,['class' => 'form-control select2','width'=>'100','data-placeholder'=>'Select panelists','required']) !!}
                 </div>
                 <div class="form-group">
                     <label class="form-label">Comment </label>
                     <textarea class="form-control" name="comment" rows="7" placeholder="text here.."></textarea>
                 </div>
                 <input type="hidden" name="hr_requisition_job_id" value="{{ $hireRequisitionJob }}">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
             {!! Form::close() !!}
         </div>
     </div>
 </div>
 @push('after-scripts')
 <script>

 </script>
 @endpush