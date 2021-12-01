@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Safari Advance Form</h3>
                </div>
                <div class="card-body">
                    <form id="form">
                        <div class="list-group">
                            <div class="list-group-item py-3" data-acc-step>
                                <h5 class="mb-0" data-acc-title>Initial Details</h5>
                                <div data-acc-content>
                                    <div class="my-3">
&nbsp;
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Choose Requisition Number</label>
                                                    <select name="country" id="select-countries" class="form-control custom-select" required>
                                                        <option value="" data-data="" selected="">Requisition No.</option>
                                                        <option value="1" data-data="">MDH-R-211</option>
                                                        <option value="2" data-data="">MDH-R-231</option>
                                                        <option value="3" data-data="">MDH-R-345</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">

                                                    <label class="form-label">Name Of Travelling Official:</label>
                                                    <input type="text" disabled name="" value="" class="form-control" placeholder="Frank Omary"/>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">

                                                    <label class="form-label">Traveling To:</label>
                                                    <input type="text" disabled name="" value="" class="form-control" placeholder="Tabora" />

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Amount Requested:</label>

                                                    <div class="input-icon">
												<span class="input-icon-addon">
													<i class="">Tshs:</i>
												</span>
                                                        <input type="number" disabled name="" value="" class="form-control" placeholder="700000">
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3" data-acc-step>
                                <h5 class="mb-0" data-acc-title>Scope of work</h5>
                                <div data-acc-content>
                                    <div class="my-3">
                                        &nbsp;
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Main Objectives <span class="form-label-small">56/100</span></label>
                                                    <textarea class="form-control" name="" rows="7" placeholder="Write your main objectives.." style="margin-top: 0px; margin-bottom: 0px; height: 179px;"></textarea>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label class="form-label">Travel Date:</label>
                                                    <input type="date" name="" value="" class="form-control" />

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label class="form-label">Return Date:</label>
                                                    <input type="date" name="" value="" class="form-control" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3" data-acc-step>
                                <h5 class="mb-0" data-acc-title>Travel Payment Breakdown</h5>
                                <div data-acc-content>
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label>Credit card:</label>
                                            <input type="text" name="card" class="form-control">
                                        </div>
                                        <div class="form-group form-row">
                                            <div class="col-sm-4">
                                                <label>Expiry:</label>
                                                <input type="text" name="expiry" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <label>CVV:</label>
                                                <input type="text" name="cvv" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
