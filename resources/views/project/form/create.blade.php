{!! Form::open(['route' => 'project.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-6" >
                    <label class="form-label">Project Code</label>
                    <input type="text" class="form-control" name="code" placeholder="eg G6767878-f" required>
                    @error('code')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="eg Community 5" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                
            </div>

            &nbsp;

            <div class="row">

                <div class="col-6">
                    <label class="form-label">Type</label>
                    {!! Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    @error('type')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6 hidden" id="region_holder">
                    <label class="form-label">Region(s)</label>
                    {!! Form::select('regions[]', $regions, null, ['class' =>'form-control select2 custom-select', 'multiple','disabled','required']) !!}
                </div>
                @error('regions')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror

            </div>

            &nbsp;

            <div class="row">
                <div class="col-6">
                    <label class="form-label">Start Date</label>
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

                <div class="col-6">
                    <label class="form-label">End Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="end_year"  type="date" min="1997-01-01" required>
                    </div>
                    @error('end_year')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Description {{--<span class="form-label-small">56/100</span>--}}</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="Enter descriptions.." required></textarea>
                </div>
                @error('description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>

            &nbsp;

            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">
                
                <button type="submit" class="btn btn-azure"  >Create Project </button>

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




