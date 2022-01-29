@extends('layouts.app')
@section('content')

    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
<br>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PAYMENT SUMMARY</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th>Requisition Number</th>
                            @if($safari_advance)
                                <th>Safari Advance number</th>
                            @elseif ($program_activity)
                                <th>Activity Number</th>
                            @endif

                            <th>Requested Amount</th>
                            <th>Paid Amount</th>
                            <th>Variance</th>

                        </tr>
                        </thead>
                        <tbody>
                        <td>{{$requisition->number}}</td>
                        @if($safari_advance)
                            <td>{{$safari_advance->number}}</td>
                        @elseif($program_activity)
                            <td>{{$program_activity->number}}</td>
                        @endif
                        <td>{{number_2_format($requisition->amount)}}</td>
                        <td>{{number_2_format($payed_amount)}}</td>
                        <td>{{number_2_format($requisition->amount -  $payed_amount)}}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
