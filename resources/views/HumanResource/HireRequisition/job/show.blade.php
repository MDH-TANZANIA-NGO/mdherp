@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="p-3">
                <h3 class="card-title mb-3">Shortlist Summary</h3>
                <div class="row widget-text">
                    <div class="col-4">
                        <h3 class="mb-0">20</h3>
                        <span class=" mb-0 fs-12 text-muted">All Applicants</span>
                    </div>
                    <div class="col-4 ">
                        <h3 class="mb-0">5</h3>
                        <span class=" mb-0 fs-12 text-muted">Shortlisted Applicants</span>
                    </div>
                    <div class="col-4 ">
                        <h3 class="mb-0">15</h3>
                        <span class=" mb-0 fs-12 text-muted">Unselect Applicants</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <ul class="demo-accordion accordionjs m-0" data-active-index="false">
            <li class="acc_section">
                <div class="acc_head">
                    <h3>Tob Title</h3>
                </div>
                <div class="acc_content" style="display: none;">
                    <p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla tempus, molestie fermentum purus euismod.</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Applicants</h3>
            </div>
            <div class="card-body">
                <table id="applications" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-15p">FIRST NAME</th>
                            <th class="wd-15p">MIDDLE NAME</th>
                            <th class="wd-15p">LAST NAME</th>
                            <th class="wd-15p">EDUCATION LEVEL</th>
                            <th class="wd-25p">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Hamis</td>
                            <td>Juma</td>
                            <td>Hamis</td>
                            <td>Bachelor Degree</td>
                            <td>show</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection