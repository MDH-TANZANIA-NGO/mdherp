{!! Form::open(['route' => 'project.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">


        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">New Stock</span>
            </div>

            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>


        <div class="card-body">
            <div class="row">

                <div class="col-6" >
                    <label class="form-label">Expense ID</label>
                    <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                        <optgroup label="Mountain Time Zone">
                            <option value="AZ">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="MT">Montana</option><option value="NE">Nebraska</option>
                            <option value="NM">New Mexico</option>
                            <option value="ND">North Dakota</option>
                            <option value="UT">Utah</option>
                            <option value="WY">Wyoming</option>
                        </optgroup>
                        <optgroup label="Central Time Zone">
                            <option value="AL">Alabama</option>
                            <option value="AR">Arkansas</option>
                            <option value="IL">Illinois</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="OK">Oklahoma</option>
                            <option value="SD">South Dakota</option>
                            <option value="TX">Texas</option>
                            <option value="TN">Tennessee</option>
                            <option value="WI">Wisconsin</option>
                        </optgroup>
                    </select>
                </div>

                <div class="col-6">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="i.e Laptops" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>


            </div>

            &nbsp;



            &nbsp;

            <div class="row">
                <div class="col-6">
                    <label class="form-label">Date Received</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="start_year" type="date" min="1997-01-01" required>
                    </div>
                    @error('start_year')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
{{--                <div class="col-6">--}}
{{--                    <label class="form-label"> Send To</label>--}}
{{--                    <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">--}}
{{--                        <optgroup label="Mountain Time Zone">--}}
{{--                            <option value="AZ">Arizona</option>--}}
{{--                            <option value="CO">Colorado</option>--}}
{{--                            <option value="ID">Idaho</option>--}}
{{--                            <option value="MT">Montana</option><option value="NE">Nebraska</option>--}}
{{--                            <option value="NM">New Mexico</option>--}}
{{--                            <option value="ND">North Dakota</option>--}}
{{--                            <option value="UT">Utah</option>--}}
{{--                            <option value="WY">Wyoming</option>--}}
{{--                        </optgroup>--}}
{{--                        <optgroup label="Central Time Zone">--}}
{{--                            <option value="AL">Alabama</option>--}}
{{--                            <option value="AR">Arkansas</option>--}}
{{--                            <option value="IL">Illinois</option>--}}
{{--                            <option value="IA">Iowa</option>--}}
{{--                            <option value="KS">Kansas</option>--}}
{{--                            <option value="KY">Kentucky</option>--}}
{{--                            <option value="LA">Louisiana</option>--}}
{{--                            <option value="MN">Minnesota</option>--}}
{{--                            <option value="MS">Mississippi</option>--}}
{{--                            <option value="MO">Missouri</option>--}}
{{--                            <option value="OK">Oklahoma</option>--}}
{{--                            <option value="SD">South Dakota</option>--}}
{{--                            <option value="TX">Texas</option>--}}
{{--                            <option value="TN">Tennessee</option>--}}
{{--                            <option value="WI">Wisconsin</option>--}}
{{--                        </optgroup>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="col-sm-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" placeholder="i.e 10" required>
                    @error('quantity')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Unit</label>
                    <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                        <optgroup label="Mountain Time Zone">
                            <option value="AZ">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="MT">Montana</option><option value="NE">Nebraska</option>
                            <option value="NM">New Mexico</option>
                            <option value="ND">North Dakota</option>
                            <option value="UT">Utah</option>
                            <option value="WY">Wyoming</option>
                        </optgroup>
                        <optgroup label="Central Time Zone">
                            <option value="AL">Alabama</option>
                            <option value="AR">Arkansas</option>
                            <option value="IL">Illinois</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="OK">Oklahoma</option>
                            <option value="SD">South Dakota</option>
                            <option value="TX">Texas</option>
                            <option value="TN">Tennessee</option>
                            <option value="WI">Wisconsin</option>
                        </optgroup>
                    </select>
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Description {{--<span class="form-label-small">56/100</span>--}}</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="Enter project descriptions..." required></textarea>
                </div>
                @error('description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>

            &nbsp;

            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">

                        <button type="submit" class="btn btn-azure"  >Receive Goods </button>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}

@push('after-scripts')
    <script>
        $(document).ready(function () {
            let $type_input = $("select[name='type']");
            let $region_holder = $("#region_holder");
            let $region_input = $("select[name='regions[]']");

            $region_holder.hide();

            $type_input.change(function (event){
                event.preventDefault();
                let $value = $(this).val();
                if($value === "{{ config('mdh.project.with_region') }}"){
                    $region_holder.show()
                    $region_input.attr('disabled',false);
                }else{
                    $region_holder.hide();
                    $region_input.attr('disabled',true);
                }
            });
        });
    </script>
@endpush




