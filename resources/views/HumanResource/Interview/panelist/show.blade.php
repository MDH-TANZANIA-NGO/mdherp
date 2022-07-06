<div class="card">
    <div class="card-header">
        <h3 class="card-title">PANELIST LIST</h3>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> Name </th>
                            <th> TECHNICAL STAFF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_questions = 0; ?>
                        @foreach($panelists as $key=>$panelist)
                        <tr>
                            <td> {{($key+1) }}</td>
                            <td> {{ $panelist->full_name }} </td>
                            <td>
                                @if(!isset($show)) 
                                 <input type="radio" name="technical_staff" value="{{$panelist->id}}"> 
                                @endif
                                @if(isset($show) && $panelist->technical_staff == 1) 
                                 <i class="fa fa-check"></i>
                                @endif

                            </td>
                        </tr>
                        <?php $total_questions = ($key + 1); ?>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="total_questions" value="{{ $total_questions }}">
                <input type="hidden" name="applicant_id" id="applicant_id" value="" required />
                <input type="hidden" name="interview_id" id="interview_id" value="" required />
            </div>
        </div>
    </div>
</div>