<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        <div class="tab-pane active" id="processing">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style ="">#</th>
                                <th style ="">OBJECTIVE/GOAL</th>
                                <th style ="">ACTION PLAN</th>
                                <th style ="">AREA OF CHALLENGE/ OPPORTUNITIES FOR IMPROVEMENT</th>
                                <th style ="width: 15%">RATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr_objectives AS $key => $objective)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $objective->goal }}</td>
                                    <td>{{ $objective->plan }}</td>
                                    <td>{{ $objective->challenge }}</td>
                                    <td>{!! Form::select('scole[]',$pr_rate_scales,null,['class' => 'form-control text-center', 'placeholder' => 'Select','required']) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        {!! Form::submit('submit rates',['class' => 'btn btn-primary col-sm-12 col-lg-12 col-md-12 col-xl-12']) !!}
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("#objectives").DataTable();
        });
    </script>
@endpush