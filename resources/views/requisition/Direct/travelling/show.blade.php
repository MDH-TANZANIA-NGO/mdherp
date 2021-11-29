
<!-- Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">REQUISITION SUMMARY</h3>
            </div>
            <div class="card-body">
{{--                @if($requisition->user_id==access()->id())--}}
{{--                <div class="">--}}
{{--                    <h4 class="mb-1">Hi <strong>{{ $requisition->user->full_name_formatted }}</strong>,</h4>--}}
{{--                    You have requested Amount of <strong>{{$requisition->amount}}</strong> (TZS) for activity:--}}
{{--                    <p>{{$requisition->activity->title}}</p>--}}
{{--                </div>--}}
{{--                @else--}}

{{--                    <div class="">--}}
{{--                        <p>{{$requisition->activity->title}}</p>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="dropdown-divider"></div>--}}
{{--                <div class="row pt-4">--}}
{{--                    <div class="col-lg-6 ">--}}
{{--                        <address>--}}
{{--                            <strong>Project name: </strong><span class="text-primary" >{{$requisition->project->title}}</span><br>--}}
{{--                            <strong>Sub Program area:</strong>  <span class="text-primary" >{{$requisition->activity->subprogram->programArea->title}}</span><br>--}}
{{--                            <strong>Numeric Output: </strong> <span class="text-primary" >200</span><br>--}}
{{--                            <strong>Output unit:</strong> <span class="text-primary" >  Pieces</span><br>--}}
{{--                        </address>--}}
{{--                    </div>--}}

{{--                </div>--}}
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
                        <tr>
                            <td>
                                <p class="font-w600 mb-1">Elinipendo Mziray</p>
                                <div class="text-muted">Data collection</div>
                                <div class="nn" style="color: green"><i class="fe fe-map-pin"></i> Nzega</div>
                            </td>
                            <td class="text-center">10</td>
                            <td class="text-right">60,000</td>
                            <td class="text-right">200,000</td>
                            <td class="text-right">60,000</td>
                            <td class="text-right">200,000</td>
                        </tr>



                        <tr>
                            <td colspan="5" class="font-w600 text-right">Total TZS</td>
                            <td class="text-right">240,000.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="font-weight-bold text-uppercase text-right">Total USD</td>
                            <td class="font-weight-bold text-right">$120.00</td>
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


