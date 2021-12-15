@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
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
                    <div class="col-md-6" >
                <div class="form-group">
                    <label class="form-label">Country</label>
                    <select name="country" id="select-countries" class="form-control custom-select">
                        <option value="br" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/br.svg&quot;}">Brazil</option>
                        <option value="cz" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/cz.svg&quot;}">Czech Republic</option>
                        <option value="de" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/de.svg&quot;}">Germany</option>
                        <option value="pl" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/pl.svg&quot;}" selected="">Poland</option>
                    </select>
                </div>
                    </div>
                    <div class="col-md-6" >
                <div class="form-group">
                    <label class="form-label">Input group</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="">

                    </div>
                </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6" >

                <div class="form-group">
                    <label class="form-label">Input group buttons</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary">Action</button>
                            <button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)">News</a>
                                <a class="dropdown-item" href="javascript:void(0)">Messages</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>

                    <div class="col-md-6" >

                <div class="form-group">
                    <label class="form-label">Separated inputs</label>
                    <div class="row gutters-xs">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Search for...">
                        </div>
                        <span class="col-auto">
													<button class="btn btn-secondary" type="button"><i class="fe fe-search"></i></button>
												</span>
                    </div>
                </div>
                        </div>

                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Message <span class="form-label-small">56/100</span></label>
                            <textarea class="form-control" name="example-textarea-input" rows="7" placeholder="text here.."></textarea>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6" >
                <div class="form-group">
                    <div class="form-label">Bootstrap's Custom File Input</div>
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
