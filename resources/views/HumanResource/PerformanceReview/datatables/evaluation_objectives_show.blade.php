<div class="card">
    <div class="card-header"><h3 class="card-title">performance goals</h3></div>
        <div class="card-body">
         
        @if($can_update_attribute_rate_resource)
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
                <div class="tab-pane active" id="processing">
                    <div class="card-body">
                       <div class="table-responsive">
                            <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>OBJECTIVE/GOAL</th>
                                        <th>ACTION PLAN</th>
                                        <th>AREA OF CHALLENGE/ OPPORTUNITIES FOR IMPROVEMENT</th>
                                        <th style="width: 15%">RATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pr_objectives AS $key => $objective)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $objective->goal }}</td>
                                            <td>{{ $objective->plan }}</td>
                                            <td>{{ $objective->challenge }}</td>
                                            <td>{!! Form::select('rate',$pr_rate_scales,$objective->pr_rate_scale_id,['class' => 'form-control text-center rate-select', 'placeholder' => 'Select', 'data-objective-uuid' => $objective->uuid]) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else

        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
                <div class="tab-pane active" id="processing">
                    <div class="card-body">
                       <div class="table-responsive">
                            <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>OBJECTIVE/GOAL</th>
                                        <th>ACTION PLAN</th>
                                        <th>AREA OF CHALLENGE/ OPPORTUNITIES FOR IMPROVEMENT</th>
                                        <th style="width: 2%">RATE</th>
                                        <th>DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pr_objectives AS $key => $objective)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $objective->goal }}</td>
                                            <td>{{ $objective->plan }}</td>
                                            <td>{{ $objective->challenge }}</td>
                                            <td>{{ $objective->rate ? $objective->rate->rate : 'not set' }}</td>
                                            <td>{{ $objective->rate ? $objective->rate->description: 'not set' }}</td>
                                        </tr>
                                    @endforeach
                                    @if($pr_objectives->whereNull('pr_rate_scale_id'))
                                    <tr>
                                        <td>#</td>
                                        <td colspan="3">Average Rate for Part A</td>
                                        <td colspan="2">{{ avg_per_pr_objective($pr_report->parent) }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif


        </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("#objectives").DataTable();
            let $rate_select = $(".rate-select");
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $rate_select.change(function(event){
                event.preventDefault();
                let $selected_rate = $(this).val();
                let $selected_objective = $(this).attr('data-objective-uuid');
                let $url = '{{ route("hr.pr.objective.update_scale_rate", ":uuid") }}';
                $url = $url.replace(':uuid', $selected_objective);
                $.ajax({
                    url: $url,
                    type: 'POST',
                    data : {
                        rate_scale : $selected_rate,
                        _token: _token
                    },
                    success: function (data) {
                        if(data){
                            not1()
                        }
                    },
                    error: function (error) {
                        not2()
                    }
                });
            });
        });
    </script>
@endpush