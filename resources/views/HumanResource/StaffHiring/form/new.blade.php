<div class="row">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <h3 class="card-title">MDH
            </h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'refferenceform.store']) !!}

            <div class="card-body">
                <div class="row">
                    <div  class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Referring To:</label>
                            <input type="text" name="candidate_name" class="form-control" placeholder="Jane Doe" >
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Reference Report Form (To be completed by a given Referee/ Employer)</h3>
                        <div class="card-options ">
{{--                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th>Item No.</th>
                                <th>KEY AREA</th>
                                <th>RESPONSE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>For how long have you known him/her?</td>
                                <td><input type="text" name="know_period" class="form-control" placeholder="" required></td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>In what capacity have you known him/her?</td>
                                <td><input type="text" name="know_capacity" class="form-control" placeholder="" required></td>

                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Is he/she related to you? If “yes” how?</td>
                                <td><textarea class="form-control" name="relate" rows="2" placeholder="text here.."></textarea></td>

                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td colspan="2">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>How would you rate the candidate in terms of:</td>
                                        </tr>

                                        <tr><td style="width: 50%" >a) Professional conduct</td><td> <input type="text" name="rate_proffesional" class="form-control" placeholder="" required ></td></tr>
                                        <tr><td style="width: 50%">b) Commitment to work</td><td><input type="text" name="rate_commitment" class="form-control" placeholder="" required></td></tr>
                                        <tr><td style="width: 50%">c) Knowledge of work</td><td><input type="text" name="rate_knowledge" class="form-control" placeholder="" required></td></tr>
                                        <tr><td style="width: 50%">d) Trustworthy</td><td><input type="text" name="rate_trust" class="form-control" placeholder="" required></td></tr>
                                        <tr><td style="width: 50%">e) Meeting dead lines</td><td><input type="text" name="rate_deadlines" class="form-control" placeholder="" required></td></tr>
                                        <tr><td style="width: 50%">f) Relationship with other workers</td><td><input type="text" name="rate_relationship_with_others" class="form-control" placeholder="" required></td></tr>
                                        </tbody>
                                    </table>
                                </td>



                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Please, give your general/specific opinion on his/her employability.</td>
                                <td><textarea class="form-control" name="general_opinion" rows="2" placeholder="text here.."></textarea></td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        Thank you for your cooperation.
                    </div>
                </div>
                &nbsp;
                <div class="row">
                    <div  class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Completed By:</label>
                            <input type="text" name="ref_name" class="form-control" placeholder="Full Name" required>
                        </div>
                    </div>
                    <div  class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Email:</label>
                            <input type="text" name="ref_email" class="form-control" placeholder="janedoe@example.com"  >
                        </div>
                    </div>
                </div>
                &nbsp;
                    <div class="row">
                        <div  class="col-md-12">
                            <div class="form-group">

                                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit</button>

                            </div>
                        </div>
                    </div>


            </div>



            {!! Form::close() !!}
        </div>
    </div>
</div>
