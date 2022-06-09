<div class="row">
    <div class="col-12">
        {!! Form::open(['route' => ['user.update_definitions', $user], 'method' => 'post']) !!}
        @foreach($wf_module_groups as $group)
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Module: {{ $group->name }}</legend>

                <div class="control-group">

                    @foreach($group->modules as $module)

                        <div class="row" style="background-color: rgb(238, 241, 248)">
                            <div class="col-sm-3" style="margin-top: 15px;">
                        <h6>{{ $module->name }}</h6>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            @foreach($module->definitions as $key => $definition)
                                <div class="col-sm-4 col-lg-4 col-xl-4 col-md-4">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-secondary d-inline">
                                            <input type="checkbox" id="definition_{{ $definition->id }}" value="{{ $definition->id }}" name="definitions[]" {{ $user->hasWfDefinition($definition->id) ? 'checked' : '' }}>
                                            <label for="definition_{{ $definition->id }}" title="{{$definition->description}}">{{ $key + 1 }} . {{ $definition->description }}</label> <br>
                                            <span style="display: block; font-size: 12px !important; color: grey; margin-top: -5px">{{ $definition->designation->unit->name." ".$definition->designation->name }}</span>
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

        <hr>
        <div class="col-12 mt-5">
            <input type="submit" class="btn btn-flat btn-secondary" value="{{ __('label.update') }}">
        </div>
        {!! Form::close() !!}
    </div>
</div>
