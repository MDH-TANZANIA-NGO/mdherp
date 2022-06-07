@extends('layouts.app')
@section('content')


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
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <p>page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
                        </div>
                        <div class="tab-pane" id="tab2">
                            @include('gofficer.govRate.form.create')
                            <br>
                            @include('gofficer.govRate.datatable.all')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

     Datatable starts here
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Title</span>
    </div>






    {{-- Datatable starts here --}}
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Rate</span>
    </div>


    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('gofficer.grate.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('gofficer.assignment.index')

@endsection
