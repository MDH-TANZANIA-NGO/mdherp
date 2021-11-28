@extends('layouts.app')

@section('content')

    @if($items->count() > 0 or $travellingCost->count()>0)

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

    @switch($requisition->requisition_type_id)
        @case(1)

        @include('requisition.procurement.items.details')
        @include('requisition.procurement.forms.create',['items'=>$requisition->items])

        @break

        @case(2)

        @switch($requisition->requisition_type_category)
            @case(1)

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
