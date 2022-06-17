@push('after-styles')
    <style>
        .application_category{
            color: #000000;
        }
    </style>
@endpush

@if(isset($value['app_category_summary'] ))
    @foreach($value['app_category_summary']  as $app_category_summary)

        @foreach($app_category_summary as $key => $module_sub_summary)

            {{--check if is module with sub categories--}}
            @if(isset($module_sub_summary))

                @foreach($module_sub_summary['app_categories'] as $category)


                    @if(isset($module_sub_summary[$value['id']][$category->id]['category_name']))
                        @if($module_sub_summary[$value['id']][$category->id]['category_count'] > 0)

                            <a class="application_category" id="{!! $category->id !!}"  href="{{ url("/") . "/" . request()->route()->uri() }}?wf_module_id={{ $value['id'] }}&application_category_id={{ $category->id }}"  >

                                {!! $module_sub_summary[$value['id']][$category->id]['category_name'] . ' - [ ' .  $module_sub_summary[$value['id']][$category->id]['category_count'].' ] '  !!}
                            </a>|


                        @endif
                    @endif


                @endforeach
            @endif

        @endforeach

    @endforeach
@endif
