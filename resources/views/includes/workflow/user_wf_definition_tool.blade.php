@push('in-styles')
    {{ Html::style(url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')) }}
@endpush
{!! Form::open(['method' => 'post','class' =>'form-horizontal','autocomplete' =>'off','name'=>'update_definition_form'])
 !!}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label><i class="fas fa-users mr-3"></i>{{ __('label.user') }}</label>
            <select name="users[]" class="users_list" multiple="multiple">

            </select>
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-secondary">{{ __('label.update') }}</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@push('in-scripts')
    {!! Html::script(url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')) !!}
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function () {


        })
    </script>
@endpush
