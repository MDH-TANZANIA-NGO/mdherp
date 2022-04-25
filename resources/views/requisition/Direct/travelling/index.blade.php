<div class="card-body">
    <div class="text-wrap">
        <div class="example">
            <div class="tags">

                <div class="tag">
                    Available Fund
                    <span class="tag-addon tag-success">
                        @if($requisition->fundChecker == null)
                            {{number_2_format($requisition->budget->actual_amount)}}
                        @else
                            {{number_2_format($requisition->fundChecker->actual_amount)}}
                        @endif
                    </span>
                </div>
                <span class="tag tag-dark">
														Total amount requested
														<span class="tag-addon tag-warning">{{number_2_format($requisition->amount)}}</span>
													</span>
            </div>
        </div>
@include('requisition.Direct.travelling.forms.create')
@include('requisition.Direct.travelling.datatables.all')


