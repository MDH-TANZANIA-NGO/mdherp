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
                                        <th class="text-right"  style="width: 20%">Request Amount</th>
                                        <th class="text-right" style="width: 5%">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td class="text-center"><span style="color: red"></span></td>
                                        <td>{!! Form::select('equipment_id',$equipments,null,['class'=>'form-control', 'placeholder'=>'Select']) !!}</td>
                                        <td class="text-center" id="equipment_type"></td>
                                        <td class="text-left" id="specs"></td>
                                        <td class="text-right">
                                            <input type="number" name="requested_amount" class="form-control" placeholder=""/>
                                            <span class="badge badge-danger hidden" id="amount_alert"></span>
                                        </td>
                                        <td><button type="submit" class="btn btn-primary">Add</button></td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td class="text-center"><span style="color: red"><i class="fa fa-trash-o"></i></span></td>--}}
{{--                                        <td>--}}
{{--                                            <p class="font-w600 mb-1">Ilala DC</p>--}}
{{--                                            <div class="text-muted">To do HTS and TDM</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-center">Laptops</td>--}}
{{--                                        <td class="text-right">7</td>--}}
{{--                                        <td class="text-right">1000000</td>--}}
{{--                                        <td class="text-right">100000</td>--}}
{{--                                    </tr>--}}


{{--                                    <tr>--}}
{{--                                        <td colspan="5" class="font-w600 text-right">Total Amount ($)</td>--}}
{{--                                        <td class="text-right">$50.00</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="5" class="font-weight-bold text-uppercase text-right">Total Amount (TZS)</td>--}}
{{--                                        <td class="font-weight-bold text-right">450.00</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="6" class="text-right">--}}
{{--                                            <button type="button" class="btn btn-success" onClick="javascript:window.print();"><i class="si si-folder"></i> Save</button>--}}
{{--                                            <button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-share-alt"></i> Submit</button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
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
                console.log($equipment);
                $.get("{{ route('equipment.get_by_id') }}", { equipment_id: $equipment},
                    function(data, status){
                        if(data){
                            $equipment_type.text(data.equipment_title)
                            $specs.text(data.specs)
                            $requested_amount.attr('placeholder', data.price_range_from +' - ' +data.price_range_to )
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
