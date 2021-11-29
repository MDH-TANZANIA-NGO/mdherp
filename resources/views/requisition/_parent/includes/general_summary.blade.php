<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">REQUISITION SUMMARY</h3>
            </div>
            <div class="card-body">
                @if($requisition->user_id==access()->id())
                    <div class="">
                        <h4 class="mb-1">Hi <strong>{{ $requisition->user->full_name_formatted }}</strong>,</h4>
                        You have requested Amount of <strong>{{$requisition->amount}}</strong> (TZS) for activity:
                        <p>{{$requisition->activity->title}}</p>
                    </div>
                @else

                    <div class="">
                        <p>{{$requisition->activity->title}}</p>
                    </div>
                @endif

                <div class="dropdown-divider"></div>
                <div class="row pt-4">
                    <div class="col-lg-6 ">
                        <address>
                            <strong>Project name: </strong><span class="text-primary" >{{ $requisition->project_title}}</span><br>
                            <strong>Sub Program area:</strong>  <span class="text-primary" >{{ $requisition->program_area_title}}</span><br>
                            <strong>Numeric Output: </strong> <span class="text-primary" >{{ $requisition->numeric_output_unit }}</span><br>
                            <strong>Output unit:</strong> <span class="text-primary" >{{ $requisition->output_unit_title }}</span><br>
                        </address>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
