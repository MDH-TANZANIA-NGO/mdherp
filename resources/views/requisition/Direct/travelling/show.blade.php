
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
                            <th class="text-center" >Departure</th>
                            <th class="text-center" >Returning</th>
                            <th class="text-right" style="width: 1%">Perdiem</th>
                            <th class="text-right" style="width: 1%">Ontransit</th>
                            <th class="text-right" style="width: 1%">Accomodation</th>
                            <th class="text-right" style="width: 1%">Transportation</th>
                            <th class="text-right" style="width: 1%">Others</th>
                            <th class="text-right" style="width: 1%">Total</th>
                        </tr>

                        @foreach($travelling_costs as $cost)
                        <tr>
                            <td>
                                {{ $cost->user->full_name_formatted }}</p>
                                <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{ $cost->district->name }}</div>
                            </td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($cost->from)) }}</td>
                            <td class="text-center">{{ date('d-M-Y', strtotime($cost->to)) }}</td>
                            <td class="text-right">{{ number_2_format($cost->perdiem_total_amount )}}</td>
                            <td class="text-right">{{ number_2_format($cost->ontransit )}}</td>
                            <td class="text-right">{{ number_2_format($cost->accommodation )}}</td>
                            <td class="text-right">{{ number_2_format($cost->transportation) }}</td>
                            <td class="text-right">{{ number_2_format($cost->other_cost) }}   <div class="nn" style="color: green">{{ $cost->others_description }}</div></td>

                            <td class="text-right">{{ number_2_format($cost->total_amount) }}</td>
                        </tr>
                        @endforeach

{{--                        <tr>--}}
{{--                            <td colspan="6" class="font-w600 text-right">Total TZS</td>--}}
{{--                            <td class="text-right">240,000.00</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td colspan="8" class="font-weight-bold text-uppercase text-right">Total </td>
                            <td class="font-weight-bold text-right">{{ number_2_format($requisition->amount) }}</td>
                        </tr>
                        <tr>
                            <td colspan="9" class="text-right">
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


