<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Panelists</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-2">
                    <label class="form-label">Panelist </label>
                </div>
                <div class="col-lg-8">
                    {!! Form::select('panelist_id[]',$users,null,['class' => 'form-control select2','multiple'=>'true','data-placeholder'=>'Select panelists','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>