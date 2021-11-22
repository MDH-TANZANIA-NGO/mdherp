@extends('layouts.app',['title' => __('label.workflow.index'), 'current_system' => ''])
@push('in-styles')
    {{ Html::style(url('plugins/jstree/themes/default/style.css')) }}
@endpush

@push('nav-head')
    <a href="{{ route('setting.invoke') }}" class="link"><i class="fas fa-cogs mr-2"> </i>
        {{ __('label.setting.title') }}</a> > {{ __('label.workflow.index') }}
@endpush
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">{{ __('label.workflow.index') }}</h3>
        </div>
        <div class="card-body">
            <div id="treeBasic">
                <ul>
                    @foreach($wf_modules as $wf_module)
                        <li>
                            {{ $wf_module->name }}  <small>[ <i style="color: grey">{{ $wf_module->description }}</i> ]</small>
                            @foreach($wf_module->definitions as $wf_definition)
                                <ul>
                                    <li data-jstree='{ "icon" : "fas fa-people-carry"}' style="background-color:
                                    #0b2e13"  data-wf_definition_id="{{ $wf_definition->id }}">
                                         <a href="#">
                                             <span style="color: darkgreen; font-weight: bolder">LEVEL {{ $wf_definition->level
                                             }}</span>
                                             <small>
                                                 {{ $wf_definition->description }}
                                                 ( <i style="color: grey">{{ $wf_definition->msg_next }}</i> )
                                             </small>
                                         </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


    @include('includes.workflow.user_wf_definition_tool',['user' => access()->user()])

@endsection

@push('in-scripts')
    {!! Html::script(url('plugins/jstree/jstree.js')) !!}
    {!! Html::script(url('plugins/jstree/examples.treeview.js')) !!}
@endpush

@push('after-scripts')
{{--    {!! Html::script(url('dist/tree-view/treeview.js')) !!}--}}
    <script>
        $(document).ready(function () {

            let $update_definition_form = $("form[name='update_definition_form']");

            let $users_list = $('.users_list').bootstrapDualListbox({
                selectorMinimalHeight: 300,
                showFilterInputs:true,
                refresh: true
            });

            $('#treeBasic').on("changed.jstree", function (e, data) {
                let $definition = data.node.data.wf_definition_id;
                if($definition){
                    $update_definition_form.attr('action', base_url+'/users/'+$definition+'/assign-definition');
                    showSelected($definition);
                }
            });

            function showSelected(wf_definition_id) {
                $('.users_list').empty();
                let $route = "{{ route('user.all_with_wf_definition',':wf_definition_id') }}";
                $route = $route.replace(':wf_definition_id', wf_definition_id);
                $.getJSON($route,function (data) {
                    $.each(data, function (i, item) {
                        console.log(item);
                        let $check_if_selected = "";
                        if(item.wf_definition_id != null){
                            if(item.wf_definition_id === wf_definition_id){
                                $check_if_selected = 'selected';
                            }
                        }
                        console.log($check_if_selected);
                        if(item.id != 1){
                            $users_list.append("<option value=" + item.id + " " + $check_if_selected + ">" + item.name +
                                " ( " + item.uni + " )" + "</option>");
                        }
                    });
                    $users_list.trigger('bootstrapDualListbox.refresh' , true);

                });
            }

        })
    </script>
@endpush

