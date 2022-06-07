@push('after-styles')
    {{ Html::style(url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')) }}
@endpush
{!! Form::open(['route' => 'g_rate.assign', 'method'=>'POST']) !!}
<div class="row mt-4">
    <div class="col-12">
        <div class="form-group">
            <label>{{ __('RATES') }}</label>
            {!! Form::select('rate',$gov_rates,old('rate'),['class'=>'form-control','placeholder' => 'Select Rate']) !!}
        </div>

        <div class="form-group">
            <select name="scales[]" class="rates_list" multiple="multiple">

            </select>
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class="form-group row mt-5">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary">{{ __('Allocate') }}</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@push('after-scripts')
    {!! Html::script(url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')) !!}
    <script>
        $(document).ready(function () {
            let $rate_select = $("select[name='rate']");
            let $rates_list = $('.rates_list').bootstrapDualListbox({
                selectorMinimalHeight: 300,
                showFilterInputs:true,
                refresh: true
            });

            $rate_select.change(function (event) {
                event.preventDefault();
                let $selected = $(this).val();
                $rates_list.empty();
                let $route = "{{ route('g_scale.government_rate') }}";
                $.get($route, function (data) {
                    console.log(data);
                    $.each(data, function (i, item) {
                        let $check_if_selected = "";
                        if (item.government_rate_id != null) {
                            if (item.government_rate_id == $selected) {
                                $check_if_selected = 'selected';
                            }
                        }
                        $rates_list.append("<option value=" + item.id + " " + $check_if_selected + ">" + item.title + "</option>");
                    });
                    $rates_list.trigger('bootstrapDualListbox.refresh', true);
                });

            });

        });
    </script>

@endpush
