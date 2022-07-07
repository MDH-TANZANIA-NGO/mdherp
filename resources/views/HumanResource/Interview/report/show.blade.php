@extends('layouts.app')
@section('content')
<div class="row mb-2">
    <div class="col-lg-12">
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW REPORT</h3>
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
                      
                    </tbody>
                </table>
                @each('HumanResource.Interview.report.interveiw_list', $interviews, 'interview')
                @include('HumanResource.Interview.report.panelist_list')
                @include('HumanResource.Interview.report.recommendation_list')

            </div>
        </div>
    </div>
</div>
@endsection