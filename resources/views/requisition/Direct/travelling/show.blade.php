
<!-- Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">REQUISITION SUMMARY</h3>--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr class=" ">
                            <th>Traveller's Info</th>
                            <th class="text-center" style="width: 1%">Days</th>
                            <th class="text-right" style="width: 1%">Perdiem</th>
                            <th class="text-right" style="width: 1%">Accomodation</th>
                            <th class="text-right" style="width: 1%">Transportation</th>
                            <th class="text-right" style="width: 1%">Others</th>
                        </tr>

                        @foreach($travelling_costs as $cost)
                        <tr>
                            <td>
                                <p class="font-w600 mb-1">{{ $cost->user->full_name_formatted }}</p>
                                <div class="text-muted">Data collection</div>
                                <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>
                                    @foreach($cost->districts as $district)
                                        {{ $district->name }},
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">{{ $cost->no_days }}</td>
                            <td class="text-right">60,000</td>
                            <td class="text-right">{{ $cost->accommodation }}</td>
                            <td class="text-right">{{ $cost->transportation }}</td>
                            <td class="text-right">{{ $cost->other_cost }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" class="font-w600 text-right">Total TZS</td>
                            <td class="text-right">240,000.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-weight-bold text-uppercase text-right">Total USD</td>
                            <td class="font-weight-bold text-right">{{ $requisition->amount }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right">
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


