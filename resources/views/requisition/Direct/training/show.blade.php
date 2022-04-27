
<!-- Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">REQUISITION SUMMARY</h3>
            </div>
            <div class="card-body">
                <div class="tags">

                    <div class="tag tag-primary">
                        {{$training->district->name}}
                        <span class="tag-addon"><i class="fe fe-map-pin"></i></span>
                    </div>
                    <div class="tag">
                        start date
                        <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($training->start_date) )}}</span>
                    </div>
                    <div class="tag">
                        end date
                        <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($training->end_date))}}</span>
                    </div>
                    <span class="tag tag-default">
														Total Participants
														<span class="tag-addon tag-warning">{{$training_costs->count()}}</span>
													</span>
                    <span class="tag tag-default">
														Total Items
														<span class="tag-addon tag-warning">{{$trainingItems->count()}}</span>
													</span>
                </div>


                <div class="table-responsive push" style="margin-top: 4%">
                    <h3 class="card-title">PARTICIPANTS LIST</h3>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr class=" ">
                            <th  class="text-center">ID</th>
                            <th  class="text-center">Participant</th>
                            <th  class="text-center">Phone</th>
                            <th  class="text-center">Days</th>
                            <th  class="text-center">Perdiem</th>
                            <th  class="text-center">Transport</th>
                            <th  class="text-center">Others</th>
                            <th  class="text-center">Other Cost Description</th>
                            <th  class="text-center">Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($trainings as $key => $training)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>
                                    <p class="font-w600 mb-1">{{ $training->user->first_name }} {{ $training->user->last_name }}</p>
{{--                                    <div class="text-muted">{{$training->description}}</div>--}}
{{--                                    <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{ $training->district->name }}</div>--}}
                                </td>
                                <th class="text-right">{{ $training->user->phone }}</th>
                                <th class="text-right">{{ $training->no_days }}</th>
                                <th class="text-right">{{ number_2_format($training->perdiem_total_amount) }}</th>
                                <th class="text-right">{{ number_2_format($training->transportation) }}</th>
                                <th class="text-right">{{ number_2_format($training->other_cost) }}</th>
                                <th class="text-right">{{ $training->others_description }}</th>
                                <th class="text-right">{{ number_2_format($training->total_amount) }}</th>
                            </tr>
                        @endforeach
                        </tbody>
                        <tr>
                            <td colspan="8" class=" text-right">Sub Total </td>
                            <td class=" text-right">{{ number_2_format($trainings->sum('total_amount') ) }}</td>
                        </tr>

{{--                        <tr>--}}
{{--                            <td colspan="5" class="font-w600 text-right">Total TZS</td>--}}
{{--                            <td class="text-right">240,000.00</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td colspan="6" class="font-weight-bold text-uppercase text-right">Total </td>--}}
{{--                            <td class="font-weight-bold text-right">{{ $requisition->amount  }}</td>--}}
{{--                        </tr>--}}

                    </table>
                </div>
                <br>
                <hr>
            <div class="table-responsive push">
                <h3 class="card-title">ITEMS LIST</h3>
                <table id="items" class="table table-bordered table-hover">
                    <thead>
                    <tr class=" ">
                        <th  class="text-center">ID</th>
                        <th  class="text-center">Item Title</th>
                        <th  class="text-center">Units</th>
                        <th  class="text-center">No Days</th>
                        <th  class="text-center">Unit Price</th>
                        <th  class="text-center">Total Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($trainingItems as $key => $items)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>
                                <p class="font-w600 mb-1">{{ $items->title}}</p>
                                {{--                                    <div class="text-muted">{{$training->description}}</div>--}}
                                {{--                                    <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{ $training->district->name }}</div>--}}
                            </td>
                            <th class="text-right">{{ $items->unit }}</th>
                            <th class="text-right">{{ $items->no_days }}</th>
                            <th class="text-right">{{ number_2_format($items->unit_price) }}</th>
                            <th class="text-right">{{ number_2_format($items->total_amount) }}</th>
                        </tr>
                    @endforeach
                    </tbody>

                    {{--                        <tr>--}}
                    {{--                            <td colspan="5" class="font-w600 text-right">Total TZS</td>--}}
                    {{--                            <td class="text-right">240,000.00</td>--}}
                    {{--                        </tr>--}}
                    <tr>
                        <td colspan="5" class=" text-right">Sub Total </td>
                        <td class=" text-right">{{ number_2_format($trainingItems->sum('total_amount'))  }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="font-weight-bold text-uppercase text-right">Grand Total </td>
                        <td class="font-weight-bold text-right">{{ number_2_format($requisition->amount)  }}</td>
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
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#example").dataTable()
            $("#items").dataTable()
        })
    </script>

@endpush
