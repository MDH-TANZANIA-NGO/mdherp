<table id="all_scales" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">TITLE</th>
{{--         <th class="wd-25p">REGISTERED DATE</th>--}}
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipment_types AS $key => $type)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $type->title }}</td>
        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{ $type->uuid }}">View modal</button></td>
    </tr>

    {!! Form::open(['route' => ['equipment_type.update', $type->uuid], 'method' => 'put',]) !!}
    <div class="modal fade" id="modal-{{ $type->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        {!! Form::text('title',$type->title,['class' => 'form-control', 'required']) !!}
                        @error('title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @endforeach
    </tbody>
</table>
