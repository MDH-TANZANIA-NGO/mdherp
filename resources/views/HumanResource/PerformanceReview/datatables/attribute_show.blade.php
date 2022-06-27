<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Attributes</h3>
		</div>
        <div class="card-body">

        @if($can_update_attribute_rate_resource)
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
                <div class="tab-pane active" id="processing">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="attributes" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:2%">#</th>
                                        <th>ATTRIBUTE</th>
                                        <th style="width: 15%">RATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pr_attributes AS $key => $attribute)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $attribute->title }}</td>
                                            <td>{!! Form::select('rate',$pr_rate_scales,
                                                $pr_report->parent->attributeRates()->where('pr_attribute_id',$attribute->id)->get()->count() == 1 ? $pr_report->parent->attributeRates()->where('pr_attribute_id',$attribute->id)->first()->pr_rate_scale_id : null
                                                ,['class' => 'form-control text-center rate-attribute-select', 'placeholder' => 'Select', 'data-pr-report-uuid' => $pr_report->parent->uuid, 'data-pr-attribute-id' => $attribute->id]) !!}</td>
                                        </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
                <div class="tab-pane active" id="processing">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="attributes" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:2%">#</th>
                                        <th>ATTRIBUTE</th>
                                        <th style="width: 2%">RATE</th>
                                        <th>RATE DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pr_report->parent->attributeRates AS $key => $attribute_rate)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $attribute_rate->attribute->title }}</td>
                                            <td>{{ $attribute_rate->rate->rate }}</td>
                                            <td>{{ $attribute_rate->rate->description }}</td>
                                        </tr>
                                     @endforeach
                                     @if($pr_report->parent->attributeRates()->whereNull('pr_rate_scale_id'))
                                    <tr>
                                        <td>#</td>
                                        <td>Average Rate</td>
                                        <td>{{ avg_per_pr_attribute_rate($pr_report->parent) }}</td>
                                        <td></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif


        </div>
    </div>
</div>


@push('after-scripts')
    <script>
        $(document).ready(function(){
            // $("#attributes").DataTable({
            //     "pageLength": 25
            // });
            let $rate_select = $(".rate-attribute-select");
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $rate_select.change(function(event){
                event.preventDefault();
                let $selected_rate = $(this).val();
                let $pr_report = $(this).attr('data-pr-report-uuid');
                let $pr_attribute = $(this).attr('data-pr-attribute-id');
                let $url = '{{ route("hr.pr.attribute_rate.store_update", [":id",":uuid"]) }}';
                $url = $url.replace(':uuid', $pr_report);
                $url = $url.replace(':id', $pr_attribute);
                $.ajax({
                    url: $url,
                    type: 'POST',
                    data : {
                        rate_scale : $selected_rate,
                        _token: _token
                    },
                    success: function (data) {
                        if(data){
                            not1()
                        }
                    },
                    error: function (error) {
                        not2()
                    }
                });
            });
        });
    </script>
@endpush