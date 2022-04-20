@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $equipment_id = $("select[name='equipment_id']");
            let $equipment_type = $("#equipment_type");
            let $specs = $("#specs");
            let $requested_amount = $("input[name='requested_amount']");
            var requisition_type_id = "{{ $requisition->requsition_type_id }}";
            var project_id = "{{ $requisition->project_id }}";
            var activity_id = "{{ $requisition->activity_id }}";
            var region_id = "{{ $requisition->region_id }}";
            var fiscal_year = null;


            $equipment_id.change(function (event){
                event.preventDefault();
                let $equipment = $(this).val();
                $requested_amount.attr('min', '');
                $requested_amount.attr('max', '');
                console.log('tip')
                $.get("{{ route('equipment.get_by_id') }}", { equipment_id: $equipment},
                    function(data, status){
                        if(data){
                            $equipment_type.text(data.equipment_title)
                            $specs.text(data.specs)
                            $requested_amount.attr('placeholder', data.price_range_from +' - ' +data.price_range_to)
                            $requested_amount.attr('min', data.price_range_from)
                            $requested_amount.attr('max', data.price_range_to)

                            console.log('tip')

                            console.log(getBudget(requisition_type_id,project_id,activity_id,region_id,fiscal_year))
                            if(getBudget(requisition_type_id,project_id,activity_id,region_id,fiscal_year) >= data.price_range_to){
                                console.log('process')
                                $specs.attr('disabled',true);
                                $requested_amount.attr('disabled',true);
                            }else{
                                $specs.attr('disabled',false);
                                $requested_amount.attr('disabled',false);
                            }

                        }else{
                            $equipment_type.text('');
                            $specs.text('');
                            $requested_amount.empty();
                        }
                    });

            });

            function getBudget(requisition_type_id,project_id,activity_id,region_id,fiscal_year)
            {
                let $available_budget = 0;
                $.get("{{ route('requisition.get_json') }}", { requisition_type_id: requisition_type_id,project_id: project_id, activity_id: activity_id, region_id: region_id, fiscal_year: fiscal_year},
                    function(data, status) {
                        if (data) {
                            let $available_budget = data.actual-data.pipeline;
                        }
                    }
                    );
                return $available_budget;
            }
        });
    </script>
@endpush
