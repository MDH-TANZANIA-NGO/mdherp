@extends('layouts.app')

@section('content')

    @if($requisition->done == FALSE and ($items->count() > 0 or $travelling_costs->count() > 0 or $training_costs->count() > 0))


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
    @else
        <div class="row mb-4">
            <div class="col-12">

        <a href="{{route('requisition.index')}}" class="btn btn-danger float-right">Exit</a>
            </div>
        </div>
    @endif

    @include('requisition._parent.includes.budget_checker', ['requisition' => $requisition])

    @switch($requisition->requisition_type_id)
        @case(1)
        @if($items->count() > 0)
            @include('requisition.procurement.items.details')
        @endif
        @include('requisition.procurement.forms.create',['items'=>$requisition->items])

        @break

        @case(2)

        @switch($requisition->requisition_type_category)
            @case(1)
            @if($travelling_costs->count() > 0)

                @endif
            @include('requisition.Direct.travelling.index',['items' => $requisition->items])
            @break

            @case(2)
            @include('requisition.Direct.training.index',['items' => $requisition->items])
            @break
        @endswitch

        @break

    @endswitch

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $equipment_id = $("select[name='equipment_id']");
            let $equipment_type = $("#equipment_type");
            let $specs = $("#specs");
            let $quantity = $("input[name='quantity']");
            let $requested_amount = $("input[name='requested_amount']");
            let $notification_alert = $("#notification_alert");
            let $description = $("textarea[name='reason']");
            let $districts = $("#districts");


            $equipment_id.change(function (event){
                event.preventDefault();
                let $equipment = $(this).val();
                $requested_amount.attr('min', '');
                $requested_amount.attr('max', '');
                $notification_alert.empty();
                $.get("{{ route('equipment.get_by_id') }}", { equipment_id: $equipment, uuid: "{{$requisition->uuid}}"},
                    function(data, status){
                        if(data){
                            console.log(data);
                            $equipment_type.text(data.equipment.equipment_title)
                            $specs.text(data.equipment.specs)
                            $requested_amount.attr('placeholder', data.equipment.price_range_from +' - ' +data.equipment.price_range_to)
                            $requested_amount.attr('min', data.equipment.price_range_from)
                            $requested_amount.attr('max', data.equipment.price_range_to)
                            let $available_budget = data.budget_summary.actual - data.budget_summary.pipeline;
                            if($available_budget >= data.equipment.price_range_to){
                                // $specs.attr('disabled',false);
                                $quantity.attr('disabled',false);
                                $requested_amount.attr('disabled',false);
                                $description.attr('disabled', false);
                                $districts.attr('disabled', false);
                            }else{
                                // $specs.attr('disabled',true);
                                $quantity.attr('disabled',true);
                                $requested_amount.attr('disabled',true);
                                $notification_alert.html("<div class='text text-danger'>Insufficient Fund <br> Remaining Fund: "+$available_budget +"</div>");
                                $description.attr('disabled', true);
                                $districts.attr('disabled', true);
                            }

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
