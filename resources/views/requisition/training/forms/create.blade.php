{!! Form::open(['route' => 'training.store', 'method' => 'post',]) !!}
<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TRAINING  FORM</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" >
                        <thead  class="bg-info text-white">
                        <tr >
                            <th class="text-white">Participant</th>
                            <th class="text-white">Days</th>
                            <th class="text-white">Destination</th>
                            <th class="text-white">Perdiem Rate</th>
                            <th class="text-white">Transport</th>
                            <th class="text-white">Others</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>	 <select class="form-control select2-show-search" name="user_id" data-placeholder="Choose one (with searchbox)" required = "required">
                                    <option value="">Search participant</option>
                                    @foreach($user_id as $user_id)
                                        <option value="{{$user_id->id}}">{{$user_id->first_name}} {{$user_id->last_name}}</option>

                                    @endforeach
                                </select></td>
                            <td><input type="number" class="form-control" name="no_days" placeholder="No days" required = "required"></td>
                            <td>	 <select class="form-control select2-show-search" name="district_id" data-placeholder="Choose one (with searchbox)">
                                    <option value="">Search Council</option>
                                    @foreach($districts as $districts)
                                        <option value="{{$districts->id}}">{{$districts->name}}</option>

                                    @endforeach
                                </select></td>
                            <td>	    <select class="form-control select2-show-search" name="perdiem_rate" data-placeholder="Choose one (with searchbox)" required = "required">
                                    <option value="">Select participant</option>
                                    @foreach($mdh_rates as $mdh_rates)
                                        <option value="{{$mdh_rates->amount}}">{{$mdh_rates->amount}}</option>

                                    @endforeach
                                </select></td>
                            <td><input type="number" class="form-control" name="transportation" placeholder="100,000" required = "required"></td>
                            <td><input type="number" class="form-control" name="other_cost" placeholder="100,000" required = "required"></td>
                            <td><button type="submit" class="btn btn-outline-info">Add</button> </td>
                        </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End  Row -->

{!! Form::close() !!}
