{!! Form::open(['route' => 'budget.store','method'=>'POST']) !!}
<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {!! Form::label('activity', __("label.activity"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('activity', $activities, old('activity'),['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                {!! $errors->first('activity', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('fiscal_year', __("label.fiscal_year"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('fiscal_year', $fiscal_years, old('fiscal_year'),['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                {!! $errors->first('fiscal_year', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 hidden" id="amount_holder">
            <div class="form-group">
                {!! Form::label('amount', __("Amount"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('amount', null, old('amount'),['class' =>'form-control', 'placeholder' => __('Amount'), 'required']) !!}
                {!! $errors->first('amount', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 hidden" id="numeric_output_holder">
            <div class="form-group">
                {!! Form::label('output', __("Numeric Output"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('output', null, old('output'),['class' =>'form-control', 'placeholder' => __('Numeric Output'), 'required']) !!}
                {!! $errors->first('output', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>


        <div class="col-12 table-responsive">
            <table class="table card-table table-vcenter text-nowrap hidden" id="additional_table">
                <thead >
                <tr>
                    <th colspan="2">Regions</th>
{{--                    <th>Region</th>--}}
                    <th>Amount</th>
                    <th>Numeric Output</th>
                </tr>
                </thead>
                <tbody id="additional_inputs">
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left:40%;">Submit </button>


    </div>
</div>
{!! Form::close() !!}


@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $activity_select = $("select[name='activity']");
            let $additional_inputs = $("#additional_inputs");
            let $regions = $("input[name='regions[]']");
            let $numeric_output = $("input[name='output']");
            let $numeric_output_holder = $("#numeric_output_holder");
            let $additional_table = $("#additional_table");
            let $amount_holder = $("#amount_holder");
            let $amount_input = $("input[name='amount']");

            $activity_select.change(function (event) {
                event.preventDefault();
                get_regions($(this).val());
            })

            function get_regions(activity_id){
                let $route = base_url+'/regions/'+activity_id+'/activity';
                $.get($route, function(data, status){
                    $additional_inputs.empty();
                    $numeric_output_holder.addClass('hidden');
                    $numeric_output.attr('disabled',true);
                    $additional_table.addClass('hidden');
                    $amount_holder.addClass('hidden');
                    $amount_input.attr('disabled',true);
                    if(data.length > 0){
                        $numeric_output_holder.addClass('hidden');
                        $numeric_output.attr('disabled',true);
                        $amount_holder.addClass('hidden');
                        $amount_input.attr('disabled',true);
                        $additional_table.removeClass('hidden');
                        $.each(data, function (i){
                            draw_form(data, i)
                        });
                    }else{
                        $additional_table.addClass('hidden');
                        $numeric_output_holder.removeClass('hidden');
                        $numeric_output.attr('disabled',false);
                        $amount_holder.removeClass('hidden');
                        $amount_input.attr('disabled',false);
                    }
                });
            }

            function draw_form(data, i)
            {
                $additional_inputs.append("<tr>"+
                    "<td>"+data[i].name+"</td>" +
                    '<td>'+'<input name="regions[]" type="hidden" value="'+data[i].id+'">'+'</td>'+
                    '<td>'+'<input name="amount'+data[i].id+'" type="number" class="form-control" placeholder="Amount" required>'+'</td>'+
                    '<td>'+'<input name="output'+data[i].id+'" type="number" class="form-control" placeholder="Numeric Output" required>'+'</td>'+
                    "</tr>")
            }

        });
    </script>
@endpush
