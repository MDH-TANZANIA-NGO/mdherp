<div class="row">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <h3 class="card-title">MDH</h3> &nbsp;
            <h4 class="card-title">Employee Reference Report Form (To be completed by a given Referee/ Employer)</h4>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'refferenceform.store']) !!}

            <div class="card-body">
                <div class="row">
                    <div  class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Referring To:</label>
                            <input type="text" name="candidate_name" class="form-control" placeholder="Jane Doe" disabled>
                        </div>
                    </div>
                </div>

                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">For how long have you known him/her?</label>
                            <input type="text" name="know_period" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">In what capacity have you known him/her?</label>
                            <input type="text" name="know_capacity" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Is he/she related to you? If “yes” how?</label>
                                <textarea class="form-control" name="relate" rows="2" placeholder="text here.."></textarea>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">How would you rate the candidate in terms of:</label>
                    </div>
                </div>
                &nbsp;
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">a) Professional conduct</label>
                        <input type="text" name="rate_proffesional" class="form-control" placeholder="" required >
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">b) Commitment to work</label>
                        <input type="text" name="rate_commitment" class="form-control" placeholder="" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">c) Knowledge of work</label>
                        <input type="text" name="rate_knowledge" class="form-control" placeholder="" required>
                    </div>
                </div>
                &nbsp;
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">d) Trustworthy</label>
                        <input type="text" name="rate_trust" class="form-control" placeholder="" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">e) Meeting dead lines</label>
                        <input type="text" name="rate_deadlines" class="form-control" placeholder="" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">f) Relationship with other workers</label>
                        <input type="text" name="rate_relationship_with_others" class="form-control" placeholder="" required>
                    </div>
                </div>
                &nbsp;
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Please, give your general/specific opinion on his/her employability</label>
                        <textarea class="form-control" name="general_opinion" rows="2" placeholder="text here.."></textarea>

                    </div>
                </div>



               &nbsp;
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
                            <input type="text" name="ref_name" class="form-control" placeholder="Full Name" required disabled>
                        </div>
                    </div>
                    <div  class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Email:</label>
                            <input type="text" name="ref_email" class="form-control" placeholder="janedoe@example.com" disabled >
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
