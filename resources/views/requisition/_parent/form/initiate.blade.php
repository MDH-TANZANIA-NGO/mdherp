@extends('layouts.app')

@section('content')

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
