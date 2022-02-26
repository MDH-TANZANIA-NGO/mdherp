

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">PARTICIPANTS LIST</div>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">Full Name</th>
                            <th class="wd-10p">Phone</th>
                            <th class="wd-4p">Days</th>
                            <th class="wd-10p">Perdiem</th>
                            <th class="wd-10p">Transport</th>
                            <th class="wd-10p">Others</th>
                            <th class="wd-25p">Others Description</th>
{{--                            <th class="wd-15p">Workstation</th>--}}
{{--                            <th class="wd-15p">District</th>--}}
                            <th class="wd-4p">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($training_costs as $participants)
                            <tr>

                                <td>{{$participants->user->first_name}} {{$participants->user->last_name}}</td>
                                <td>{{$participants->user->phone}}</td>
                                <td>{{$participants->no_days}}</td>
                                <td>{{number_2_format($participants->perdiem_total_amount)}}</td>
                                <td>{{number_2_format($participants->transportation)}}</td>
                                <td>{{number_2_format($participants->other_cost)}}</td>
                                <td>{{$participants->others_description}}</td>
{{--                                <td>{{$participants->user->facilities->name}}</td>--}}
{{--                                <td>{{$participants->user->district->name}}</td>--}}
                                <td><a  href="{{route('training.removeParticipant', $participants->uuid)}}"  onclick="confirm('Are you sure you need to delete participant?')"><i class="fa fa-trash"></i></a></td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>









<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">ITEMS LIST</div>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table card-table table-vcenter text-nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">Item Name</th>
                            <th class="wd-10p">Unit</th>
                            <th class="wd-10p">No Days</th>
                            <th class="wd-20p">Unit Price</th>
                            <th class="wd-25p">Total Price</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requisition_training_items as $items)
                            <tr>

                                <td>{{$items->title}}</td>
                                <td>{{$items->unit}}</td>
                                <td>{{$items->no_days}}</td>
                                <td>{{number_2_format($items->unit_price)}}</td>
                                <td>{{number_2_format($items->total_amount)}}</td>
                                <td><a  href="{{route('training.removeItem', $items->uuid)}}" onclick="confirm('Are you sure you need to remove this item?')"  ><i class="fa fa-trash"></i></a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
