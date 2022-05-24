<div class="row mb-5">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
        <div class="tags">
            <div class="tag">
                Available Fund
                <span class="tag-addon tag-success">
                    @if($requisition->fundChecker == null){{number_2_format($requisition->budget->actual_amount)}}
                    @else
                        {{number_2_format($requisition->fundChecker->actual_amount)}}
                    @endif
                </span>
            </div>
            <span class="tag tag-dark">Total amount requested <span class="tag-addon tag-warning">{{number_2_format($requisition->amount)}}</span>
        </span>
        </div>
    </div>
</div>
