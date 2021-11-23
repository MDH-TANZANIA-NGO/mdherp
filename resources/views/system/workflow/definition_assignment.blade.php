<div class="row">
    <div class="col-12">
        {!! Form::open(['route' => ['user.update_definitions', $user], 'method' => 'post']) !!}
        @foreach($wf_module_groups as $group)
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">{{ $group->name }}</legend>
                <div class="control-group">
                    @foreach($group->modules as $module)
                        <h6>{{ $module->name }}</h6>
                        <div class="row">
                            @foreach($module->definitions as $key => $definition)
                                <div class="col-sm-3">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-secondary d-inline">
                                            <input type="checkbox" id="definition_{{ $definition->id }}" value="{{
                                            $definition->id }}" name="definitions[]"
                                                {{ $user->hasWfDefinition($definition->id) ? 'checked' : '' }}>
                                            <label for="definition_{{ $definition->id }}" title="{{$definition->description}}">
                                                {{ $key + 1 }} . {{ $definition->description }}
                                            </label>
                                        </div>
                                    </div>
                                    <!-- checkbox -->
                                </div>
                            @endforeach
                        </div>
                        @if($module->count() > 1)
                            <hr>
                        @endif
                    @endforeach
                </div>

            </fieldset>
        @endforeach
        <div class="col-12 mt-5">
            <input type="submit" class="btn btn-flat btn-secondary" value="{{ __('label.update') }}">
        </div>
        {!! Form::close() !!}
    </div>
</div>
