@extends('layouts.app')

@section('content')

    @if($items->count() > 0)

    <div class="row mb-4">
        <div class="col-12">
            <a class="btn btn-primary float-right" href="{{ route('logout') }}"
               onclick="event.preventDefault();if(confirm('Are you sure you want to send it for approval')){document.getElementById('submit_requisition_form').submit()}">

                <i class="dropdown-icon mdi  mdi-logout-variant" style="color: #fff"></i> Submit for approval
            </a>
            <form id="submit_requisition_form" action="{{ route('requisition.submit',$requisition) }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    @endif

    <div class="row">

        <div class="card">

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
                                    <th class="text-right" style="width: 5%">Action</th>
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


                                            <div>TZS {{ number_2_format($item->amount) }}</div>

                                            <div>TZS {{ number_2_format($item->amount) }}</div>

                                            <div>TZS {{ number_2_format($item->amount) }}</div>


                                        </div>

                                        <div>
                                            <label>Total Amount</label>


                                            <div>TZS {{ number_2_format($item->total_amount) }}</div>


                                            <div>TZS {{ number_2_format($item->total_amount) }}</div>


                                        </div>
                                    </td>
                                    <td><button type="submit" class="btn btn-primary">Edit</button></td>
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

    <div class="row">
        <div class="card">

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
                                    <th class="text-right" style="width: 5%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                {!! Form::open(['route' => ['requisition_type.store',$requisition], 'method' => 'POST']) !!}
                                <tr>
                                    <td class="text-center"><span style="color: red"></span></td>
                                    <td>{!! Form::select('equipment_id',$equipments,null,['class'=>'form-control', 'placeholder'=>'Select','required']) !!}</td>
                                    <td class="text-center" id="equipment_type"></td>
                                    <td class="text-left">
                                        <div id="specs"></div>
                                        <hr>
                                        <div>
                                            <label>Reason to procure</label>
                                            <textarea name="reason" id="" class="form-control" cols="30" rows="10" required></textarea>
                                        </div>
                                        <hr>
                                        <div>
                                            <label>District ( allocation )</label>
                                            {!! Form::select('districts[]',$districts,null,['class' => 'form-control select2-show-search','multiple','required']) !!}
                                        </div>
                                    </td>
                                    <td class="text-right">

                                        <div>
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="" required/>
                                        </div>

                                        <div>
                                            <label>Amount</label>
                                            <input type="number" name="requested_amount" class="form-control" placeholder="" required />
                                        </div>
                                    </td>
                                    <td><button type="submit" class="btn btn-primary">Add</button></td>
                                </tr>
                                {!! Form::close() !!}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $equipment_id = $("select[name='equipment_id']");
            let $equipment_type = $("#equipment_type");
            let $specs = $("#specs");
            let $requested_amount = $("input[name='requested_amount']");


            $equipment_id.change(function (event){
                event.preventDefault();
                let $equipment = $(this).val();
                $requested_amount.attr('min', '');
                $requested_amount.attr('max', '');
                $.get("{{ route('equipment.get_by_id') }}", { equipment_id: $equipment},
                    function(data, status){
                        if(data){
                            $equipment_type.text(data.equipment_title)
                            $specs.text(data.specs)
                            $requested_amount.attr('placeholder', data.price_range_from +' - ' +data.price_range_to)
                            $requested_amount.attr('min', data.price_range_from)
                            $requested_amount.attr('max', data.price_range_to)
                        }else{
                            $equipment_type.text('');
                            $specs.text('');
                            $requested_amount.empty();
                        }
                });

            });
        });
    </script>
@endpush
