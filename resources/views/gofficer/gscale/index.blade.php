@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Government employee titles</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">

            <div class="panel panel-primary">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab1" class="active" data-toggle="tab">Register Scale</a></li>
                            <li><a href="#tab2" data-toggle="tab" class="">Register Amount</a></li>
                            <li><a href="#tab3" data-toggle="tab" class="">Assign Rate</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">

{{--                        Scales goes here--}}
                        <div class="tab-pane active" id="tab1">
                      @include('gofficer.govScale.form.create')
                            <br>
                            @include('gofficer.govScale.datatable.all')
                       </div>

{{--                        Rates Goes Here--}}
                        <div class="tab-pane" id="tab2">
                            @include('gofficer.govRate.form.create')
                            <br>
                            @include('gofficer.govRate.datatable.all')
                        </div>
                        <div class="tab-pane" id="tab3">
                            @include('gofficer.assignment.index')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-collapsed">
        <div class="card-header">
            <h3 class="card-title">Government employee titles</h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            @include('gofficer.gscale.form.create')
            <br>
            @include('gofficer.gscale.datatables.all')

        </div>
    </div>







@endsection
