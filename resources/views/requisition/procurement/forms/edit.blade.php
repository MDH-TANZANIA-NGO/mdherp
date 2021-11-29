@extends('layouts.app')
@section('content')
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
                </tr>
                </thead>

                <tbody>
                {!! Form::open(['route' => ['requisition_item.update',$item,$send], 'method' => 'PUT']) !!}
                <tr>
                    <td class="text-center"><span style="color: red"></span></td>
                    <td>{!! Form::select('equipment_id',$equipments,$item->equipment_id,['class'=>'form-control', 'placeholder'=>'Select','required']) !!}
                    </td>
                    <td class="text-center" id="equipment_type">{{ $item->equipment->type->title }}</td>
                    <td class="text-left">
                        <div id="specs">{{ $item->equipment->specs }}</div>
                        <hr>
                        <div>
                            <label>Reason to procure</label>
                            <textarea name="reason" id="" class="form-control" cols="30" rows="10" required>{{ $item->reason }}</textarea>
                        </div>
                        <hr>
                        <div>
                            <label>District ( allocation )</label>
                            {!! Form::select('districts[]',$districts,$item->districts()->pluck('districts.id'),['class' => 'form-control select2-show-search','multiple','required']) !!}
                        </div>
                    </td>
                    <td class="text-right">

                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" placeholder="" required/>
                        </div>

                        <div>
                            <label>Amount</label>
                            <input type="number" name="requested_amount" value="{{ $item->amount }}" class="form-control" placeholder="" required />
                        </div>


                        <div>
                            <label>Amount</label>
                            <button type="submit" class="btn btn-success"> Update</button>
                        </div>


                    </td>
                </tr>
                {!! Form::close() !!}

                </tbody>
        </table>
    </div>
</div>
@endsection

@include('requisition.procurement.items.includes.fetch_script')
