
<!-- Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">REQUISITION SUMMARY</h3>
            </div>
            <div class="card-body">

                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class=" ">
                            <th  class="text-center">ID</th>
                            <th  class="text-center">Participant</th>
                            <th  class="text-center">Days</th>
                            <th  class="text-center">Perdiem</th>
                            <th  class="text-center">Transport</th>
                            <th  class="text-center">Others</th>
                            <th  class="text-center">Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($trainings as $key => $training)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>
                                    <p class="font-w600 mb-1">{{ $training->user->full_name_formatted }}</p>
                                    <div class="text-muted">{{$training->description}}</div>
                                    <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{ $training->district->name }}</div>
                                </td>
                                <th class="text-right">{{ $training->no_days }}</th>
                                <th class="text-right">{{ $training->gRate->amount }}</th>
                                <th class="text-right">{{ $training->transportation }}</th>
                                <th class="text-right">{{ $training->other_cost }}</th>
                                <th class="text-right">{{ $training->total_amount }}</th>
                            </tr>
                        @endforeach
                        </tbody>

{{--                        <tr>--}}
{{--                            <td colspan="5" class="font-w600 text-right">Total TZS</td>--}}
{{--                            <td class="text-right">240,000.00</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td colspan="6" class="font-weight-bold text-uppercase text-right">Total </td>
                            <td class="font-weight-bold text-right">{{ $requisition->amount  }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">
                                {{--                                <button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-folder-alt"></i> Save </button>--}}
                                {{--                                <button type="button" class="btn btn-secondary" onClick="javascript:window.print();"><i class="si si-paper-plane"></i> Submit</button>--}}
                                <button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print </button>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


