@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Retirement Form</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
{{--                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Requisition number for retirement</label>
                            <select name="country" id="select-countries" class="form-control custom-select" required="">
                                <option value="" data-data="" selected="">Choose</option>
                                <option value="1" data-data="">MDH-R-211</option>
                                <option value="2" data-data="">MDH-R-231</option>
                                <option value="3" data-data="">MDH-R-345</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="form-group">
                            <label class="form-label">Destination</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tabora" disabled>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label class="form-label">Travel Date:</label>
                            <input type="date" name="" value="" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label class="form-label">Return Date:</label>
                            <input type="date" name="" value="" class="form-control">

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-header" style="background-color: rgb(152, 186, 217)">
                                <h3 class="card-title">Travel Summary</h3>
                                <div class="card-options ">


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
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6" >

                <div class="form-group">
                    <label class="form-label">Amount Requested & Approved</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Tshs: 700000" disabled>
                    </div>
                </div>
                    </div>

                    <div class="col-md-6" >

                <div class="form-group">
                    <label class="form-label">Amount Paid</label>

                    <input type="number" class="form-control" placeholder="">



                </div>
                        </div>

                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Activity Report <span class="form-label-small">56/100</span></label>
                            <textarea class="form-control" name="example-textarea-input" rows="7" placeholder="text here.."></textarea>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6" >
                <div class="form-group">
                    <div class="form-label">Receipt Upload</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="example-file-input-custom">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
