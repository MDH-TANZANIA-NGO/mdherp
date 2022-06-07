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
