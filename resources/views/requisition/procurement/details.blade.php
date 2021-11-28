<div class="row">

    <div class="card">

        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Procured Item Details</span>
            </div>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="">
                                <th class="text-center" style="width: 5%">#</th>
                                <th style="width: 20%">Equipment</th>
                                <th class="text-center" style="width: 10%">Equipment Type</th>
                                <th class="text-center"  style="width: 40%">Specification/description</th>
                                <th class="text-right"  style="width: 20%">Quantity / Request Amount</th>
                                @if($can_edit_resource)<th class="text-right" style="width: 5%">Action</th>@endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->equipment->title }}</td>
                                    <td class="text-center">{{ $item->equipment->type->title }}</td>
                                    <td class="text-left">
                                        <div>{{ $item->equipment->specs }}</div>
                                        <hr>
                                        <div>
                                            <label>Reason to procure</label>
                                            <div>{{ $item->reason }}</div>
                                        </div>
                                        <hr>
                                        <div>
                                            <label>District ( allocation )</label>
                                            <div>
                                                @foreach($item->districts as $district)
                                                    {{ $district->name }},
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">

                                        <div>
                                            <label>Quantity</label>
                                            <div>{{ $item->quantity }}</div>
                                        </div>

                                        <div>
                                            <label>Amount</label>
                                            <div>${{ number_2_format($item->amount) }}</div>
                                        </div>

                                        <div>
                                            <label>Total Amount</label>
                                            <div>${{ number_2_format($item->total_amount) }}</div>
                                        </div>
                                    </td>
                                    @if($can_edit_resource)<td><a href="{{ route('requisition_item.edit',[$item,'view']) }}" class="btn btn-primary">Edit</a></td>@endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
