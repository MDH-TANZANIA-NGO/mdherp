{{--pending workflows count summary --}}
<div class="row">
    <div class="col-md-12">
        @foreach(array_chunk($group_counts, 4) as $group_count)
            <div class="row">
                @foreach($group_count as $value)
                    @if($value['count'])
                        <div class="col-4 col-sm-4 col-lg-3">
                            <a id="{!! $value['id'] !!}"  href="{{ url("/") . "/" . request()->route()->uri() }}?wf_module_id={{ $value['id'] }}"   @if(!empty
                        ($value['description'])) data-toggle="popover" data-trigger="hover"
                               data-placement="bottom" data-content="{{ $value['description'] }}" @endif>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-muted mb-0"> {{ $value['name'] }} [ {{ $value['count'] }} ] </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endif
                @endforeach
            </div>
        @endforeach



    </div>
</div>

<br/>

