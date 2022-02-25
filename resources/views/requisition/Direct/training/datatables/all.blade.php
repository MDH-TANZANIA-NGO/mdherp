


<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PARTICIPANTS LIST</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Name</th>
                        <th>Days</th>
                        <th>Perdiem</th>
                        <th>Transport</th>
                        <th>Others</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($training_costs as $participants)
                        <tr>

                            <td>{{$participants->user->first_name}} {{$participants->user->last_name}}</td>
                            <td>{{$participants->no_days}}</td>
                            <td>{{$participants->perdiem_total_amount}}</td>
                            <td>{{$participants->transportation}}</td>
                            <td>{{$participants->other_cost}}</td>
                            <td><a  href="{{route('training.removeParticipant', $participants->uuid)}}" class="btn btn-outline-info"  onclick="confirm('Are you sure you need to delete participant?')"><i class="fa fa-trash"></i></a></td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
</div>


<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ITEMS LIST</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requisition_training_items as $items)
                    <tr>

                        <td>{{$items->title}}</td>
                        <td>{{$items->unit}}</td>
                        <td>{{$items->unit_price}}</td>
                        <td>{{$items->total_amount}}</td>
                        <td><a  href="{{route('training.removeItem', $items->uuid)}}" class="btn btn-outline-info" ><i class="fa fa-trash"></i></a></td>
                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
</div>

