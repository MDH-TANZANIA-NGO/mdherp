<div class="row">
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="">
                                <th class="text-center" style="width: 5%">#</th>
                                <th style="width: 20%">Equipment</th>
                                <th class="text-center" style="width: 10%">Equipment Type</th>
                                <th class="text-center"  style="width: 40%">Specification/description</th>
                                <th class="text-right"  style="width: 20%">Quantity / Request Amount</th>
                                <th class="text-right" style="width: 5%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            {!! Form::open(['route' => ['requisition_item.store',$requisition], 'method' => 'POST']) !!}
                            <tr>
                                <td class="text-center"><span style="color: red"></span></td>
                                <td>{!! Form::select('equipment_id',$equipments,null,['class'=>'form-control select2-show-search', 'placeholder'=>'Select','required']) !!}</td>
                                <td class="text-center" id="equipment_type"></td>
                                <td class="text-left">
                                    <div id="specs"></div>
                                    <hr>
                                    <div>
                                        <label>Description</label>
                                        <textarea name="reason" id="description_editor" class="form-control" cols="30" rows="10" required></textarea>
                                    </div>
                                    <hr>
                                    <div>
                                        <label>District ( allocation )</label>
                                        {!! Form::select('districts[]',$districts,null,['class' => 'form-control select2-show-search','multiple','required', 'id'=>'districts']) !!}
                                    </div>
                                </td>
                                <td class="text-right">

                                    <div>
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" placeholder="" required/>
                                    </div>

                                    <div>
                                        <label>Amount</label>
                                        <input type="number" name="requested_amount" class="form-control" placeholder="" required />
                                    </div>

                                    <div id="notification_alert"></div>

                                </td>
                                <td><button type="submit" class="btn btn-primary">Add</button></td>
                            </tr>
                            {!! Form::close() !!}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $description_editor = new RichTextEditor("#$description_editor");
        });
    </script>
@endpush
