@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vendors configuration</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class=""><a href="#tab1" class="active" data-toggle="tab">Vendors registration</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Services registered</a></li>
{{--                                                                        <li><a href="#tab3" data-toggle="tab">Vendors list</a></li>--}}
                                    {{--                                    <li><a href="#tab4" data-toggle="tab">Tab 4</a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active " id="tab1">
                                    <button class="btn btn-primary float-right" style="margin-bottom: 2%" data-toggle="modal" data-target="#largemodal">Register new vendor</button>


                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="activity_requests" >
                                            <thead >
                                            <tr>

                                                <th>Company name</th>
                                                <th>Phone</th>
                                                <th>email</th>
                                                <th>TIN</th>
                                                <th>Region</th>
                                                <th >Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendors as $vendor)
                                                <tr>
                                                    <td>{{ $vendor->company_name }}</td>
                                                    <td>{{ $vendor->phone }} </td>
                                                    <td>{{ $vendor->email }} </td>
                                                    <td>{{ $vendor->tin }} </td>
                                                    <td>{{ $vendor->region->name }}</td>
                                                    <td><a href="{{route('admin.editVendor', $vendor->id)}}" class="btn btn-primary">view</a></td>


                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @include('Hotel.forms.owners.create')
                                </div>
                                <div class="tab-pane  " id="tab2">
                                    {!! Form::open(['route' => 'admin.storeServices','class'=>'card']) !!}


                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name" placeholder="Add service name">
                                            <span class="input-group-append">
													<button class="btn btn-primary" type="submit">Add!</button>
												</span>
                                        </div>

                                    {!! Form::close() !!}
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="safari_requests" >
                                            <thead >
                                            <tr>

                                                <th>Service</th>
{{--                                                <th>created on</th>--}}
                                                <th >Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_services as $service)
                                                <tr>
                                                    <td>{{ $service->name }}</td>
{{--                                                    <td>{{ $service->created_on }}</td>--}}
                                                    <td><a href="{{route('admin.editService', $service->id)}}" class="btn btn-primary">view</a></td>


                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab3">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="activity_requests" >
                                            <thead >
                                            <tr>

                                                <th>Company name</th>
                                                <th>Contact person</th>
                                                <th>Phone</th>
                                                <th>email</th>
                                                <th>TIN</th>
                                                <th>Region</th>
                                                <th >Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendors as $vendor)
                                                <tr>
                                                    <th>{{ $vendor->company_name }}</th>
                                                    <th>{{ $vendor->first_name }} {{ $vendor->last_name }}</th>
                                                    <th>{{ $vendor->phone }} </th>
                                                    <th>{{ $vendor->email }} </th>
                                                    <th>{{ $vendor->tin }} </th>
                                                    <th>{{ $vendor->region->name }}</th>
                                                    <th><a href="{{route('admin.editVendor', $vendor->uuid)}}" class="btn btn-primary">view</a></th>


                                                </tr>
                                            </tbody>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{--                                <div class="tab-pane  " id="tab4">--}}
                                {{--                                    <p>page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>--}}
                                {{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#activity_requests").dataTable()
            $("#safari_requests").dataTable()
        })
    </script>

@endpush
