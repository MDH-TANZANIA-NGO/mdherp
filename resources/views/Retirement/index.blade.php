@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form elements</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
{{--                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Invalid Number</label>
                    <input type="text" class="form-control is-invalid state-invalid" name="example-text-input-invalid" placeholder="Invalid Number..">
                </div>
                <div class="form-group">
                    <label class="form-label">Country</label>
                    <select name="country" id="select-countries" class="form-control custom-select">
                        <option value="br" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/br.svg&quot;}">Brazil</option>
                        <option value="cz" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/cz.svg&quot;}">Czech Republic</option>
                        <option value="de" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/de.svg&quot;}">Germany</option>
                        <option value="pl" data-data="{&quot;image&quot;: &quot;./../../assets/images/flags/pl.svg&quot;}" selected="">Poland</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Input group</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-append">
													<button class="btn btn-primary" type="button">Go!</button>
												</span>
                    </div>
                </div>
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
                <div class="form-group">

                    <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-user"></i>
												</span>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">ZIP Code</label>
                    <div class="row gutters-sm">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Search for...">
                        </div>
                        <span class="col-auto align-self-center">
													<span class="form-help" data-toggle="popover" data-placement="top" data-content="<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>
													<p class='mb-0'><a href=''>USP ZIP codes lookup tools</a></p>
													" data-original-title="" title="">?</span>
												</span>
                    </div>
                </div>
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

@endsection
