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
                                    <td>{!! Form::select('rate',$pr_rate_scales,null,['class' => 'form-control text-center rate-select', 'placeholder' => 'Select', 'data-objective-uuid' => $objective->uuid]) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::open(['route' => ['hr.pr.objective.update_scale_rate',$pr_report]]) !!}
{!! Form::close() !!}

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
                            console.log(data)
                        }
                    },
                    error: function (error) {
                        console.log('')
                    }
                });
            });
        });
    </script>
@endpush