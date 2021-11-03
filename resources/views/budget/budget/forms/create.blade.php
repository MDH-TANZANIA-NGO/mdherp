<form class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('activity', __("label.activity"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('activity', $activities, old('activity'),['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
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

            <div id="additional_inputs">

            </div>

{{--            <div class="table-responsive">--}}
{{--                <table class="table card-table table-vcenter text-nowrap">--}}
{{--                    <thead >--}}
{{--                    <tr>--}}
{{--                        <th>Region</th>--}}
{{--                        <th>Amount</th>--}}
{{--                        <th>Numeric Output</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>Tabora</td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Amount"></td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Numeric Output"></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Geita</td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Amount"></td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Numeric Output"></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Dar es salaam</td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Amount"></td>--}}
{{--                        <td><input type="number" class="form-control" placeholder="Numeric Output"></td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
            <!-- table-responsive -->
            <button type="submit" class="btn btn-primary" style="margin-left:40%;">Submit </button>

        </div>
    </div>

</form>


@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $activity_select = $("select[name='activity']");
            let $additional_inputs = $("#additional_inputs");

            $activity_select.change(function (event) {
                event.preventDefault();

                get_regions($(this).val())

            })


            function get_regions(region_id){
                $.get("{{ route('region.by_activity') }}", { activity_id: region_id},
                    function(data, status){
                        console.log(data)
                        if(data.length > 0){
                            console.log(data)
                        }else{

                        }
                    });
            }
        });
    </script>
@endpush
