@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Program Activity</h3>
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
                                                    <label class="form-label">Main Objectives <span class="form-label-small"></span></label>
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
                                        &nbsp;
                                        <div class="form-group">

                                            {{--                                            table starts--}}

                                            <div class="card">
                                                <div class="card-header" style="background-color: rgb(152, 186, 217)">
                                                    <h3 class="card-title">Travel Summary</h3>
                                                    <div class="card-options ">
                                                        {{--                                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
                                                        {{--                                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>Travellor</th>
                                                            <th>Days</th>
                                                            <th>Destination</th>
                                                            <th>Perdiem Rate</th>
                                                            <th>Accommodation</th>
                                                            <th>Transport</th>
                                                            <th>Others</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- table-responsive -->
                                            </div>

                                            {{--                                            table ends--}}
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
