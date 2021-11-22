{{--pending workflows count summary --}}
<div class="row">
    <div class="col-md-12">
        @foreach(array_chunk($group_counts, 4) as $group_count)
            <div class="row">
                @foreach($group_count as $value)
                    @if($value['count'])
                        <div class="col-12 col-sm-3">
                            <a class="module_summary" id="{!! $value['id'] !!}"  href="{{ url("/") . "/" . request()->route()->uri() }}?wf_module_id={{ $value['id'] }}"   @if(!empty
                        ($value['description'])) title="{{ $value['description'] }}" data-toggle="popover" data-trigger="hover"
                               data-placement="bottom" data-content="{{ $value['description'] }}" @endif >
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">{{ $value['name'] }}</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $value['count'] }}</span>
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

