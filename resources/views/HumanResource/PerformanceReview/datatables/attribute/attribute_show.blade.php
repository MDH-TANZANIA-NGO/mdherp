<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Attributes</h3>
		</div>
        <div class="card-body">


        <div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        <div class="tab-pane active" id="processing">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="objectives" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ATTRIBUTE</th>
                                <th style="width: 15%">RATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pr_attributes AS $key => $attribute)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $attribute->title }}</td>
                                    <td>{!! Form::select('rate',$pr_rate_scales,null,['class' => 'form-control text-center rate-attribute-select', 'placeholder' => 'Select', 'data-pr-report-uuid' => $pr_report->uuid, 'data-pr-attribute-id' => $attribute->id]) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



        </div>
    </div>
</div>


@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("#objectives").DataTable();
            let $rate_select = $(".rate-attribute-select");
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $rate_select.change(function(event){
                event.preventDefault();
                let $selected_rate = $(this).val();
                let $pr_report = $(this).attr('data-pr-report-uuid');
                let $pr_attribute = $(this).attr('data-pr-attribute-id');
                let $url = '{{ route("hr.pr.attribute_rate.store_update", [":uuid",":id"]) }}';
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