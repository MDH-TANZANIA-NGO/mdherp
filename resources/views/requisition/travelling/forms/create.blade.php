{!! Form::open(['route' => 'training.store', 'method' => 'post',]) !!}
<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TRAINING FORM</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" >
                        <thead  class="bg-primary text-white">
                        <tr >
                            <th class="text-white">Travellor</th>
                            <th class="text-white">Days</th>
                            <th class="text-white">Destination</th>
                            <th class="text-white">Perdiem Rate</th>
                            <th class="text-white">Accomodation</th>
                            <th class="text-white">Transport</th>
                            <th class="text-white">Others</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>	 <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                                    <optgroup label="Mountain Time Zone">
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup label="Central Time Zone">
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </optgroup>
                                </select></td>
                            <td><input type="number" class="form-control" placeholder="No days"></td>
                            <td>	 <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                                    <optgroup label="Mountain Time Zone">
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option><option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup label="Central Time Zone">
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </optgroup>
                                </select></td>
                            <td>	    <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                                    <option>90,000</option>
                                    <option>75,000</option>
                                    <option>60,000</option>
                                </select></td>
                            <td> <input type="number" class="form-control" placeholder="100,000"></td>
                            <td><input type="number" class="form-control" placeholder="100,000"></td>
                            <td><input type="number" class="form-control" placeholder="100,000"></td>
                            <td><button type="submit" class="btn-blue">Add</button> </td>
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
