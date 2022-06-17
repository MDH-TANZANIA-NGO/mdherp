{!! Form::open(['route' => 'mdh-rates.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">


        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Rates Configuration</span>
            </div>

            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>


        <div class="card-body">
            <div class="row">

                <div class="col-6 mx-auto" >
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" placeholder="100,000">
                </div>




            </div>


            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">

                        <button type="submit" class="btn btn-azure"  >Add Rate</button>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}


@push('after-styles')
    {{ Html::style(url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')) }}
@endpush
{!! Form::open([ 'route' => 'mdh-rates.assign','method'=>'POST']) !!}
<div class="row mt-4">
    <div class="col-12">
        <div class="form-group">
            <label>{{ __('Allocate Rate') }}</label>
            {!! Form::select('rate',$mdh_rates,old('rate'),['class'=>'form-control','placeholder' => 'Select Rate']) !!}
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
                let $route = "{{ route('mdh-rates.mdh-rates') }}";
                $.getJSON($route, function (data) {
                    $.each(data, function (i, item) {
                        let $check_if_selected = "";
                        if (item.mdh_rate_id != null) {
                            if (item.mdh_rate_id == $selected) {
                                $check_if_selected = 'selected';
                            }
                        }
                        $rates_list.append("<option value=" + item.id + " " + $check_if_selected + ">" + item.name + "</option>");
                    });
                    $rates_list.trigger('bootstrapDualListbox.refresh', false);
                });

            });

        });
    </script>

@endpush







