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
                                <h5 class="mb-0" data-acc-title>Name &amp; Email</h5>
                                <div data-acc-content>
                                    <div class="my-3">
&nbsp;
                                        <div class="row">
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label class="form-label">Name Of Travelling Official:</label>
                                                    <input type="text" disabled name="" value="" class="form-control" placeholder="Frank Omary"/>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label class="form-label">Traveling To:</label>
                                                    <input type="text" disabled name="" value="" class="form-control" placeholder="Tabora" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3" data-acc-step>
                                <h5 class="mb-0" data-acc-title>Contact</h5>
                                <div data-acc-content>
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label>Telephone:</label>
                                            <input type="text" name="telephone" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile:</label>
                                            <input type="text" name="mobile" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3" data-acc-step>
                                <h5 class="mb-0" data-acc-title>Payment</h5>
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
