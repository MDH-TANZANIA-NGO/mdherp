@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Booking Requests</h3>
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
                                    <li class=""><a href="#tab1" class="active" data-toggle="tab">Activity venue booking request</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Safari hotel booking request</a></li>
{{--                                    <li><a href="#tab3" data-toggle="tab">Tab 3</a></li>--}}
{{--                                    <li><a href="#tab4" data-toggle="tab">Tab 4</a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active " id="tab1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="activity_requests" >
                                            <thead >
                                            <tr>

                                                <th>Requester</th>
                                                <th>Activity number</th>
                                                <th>Starting Date</th>
                                                <th>Region</th>
                                                <th>Venue Name</th>
                                                <th >Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activity_hotels as $key => $hotel)
                                                <tr>
                                                    <th>{{ $hotel->requester }}</th>
                                                    <th>{{ $hotel->safari_number }}</th>
                                                    <th>{{ $hotel->start_date }}</th>
                                                    <th>{{ $hotel->district->region->name }}</th>
                                                    <th>{{ $hotel->name }}</th>
                                                    <th>
                                                        @if($hotel->reserved == false)
                                                            <a href="{{route('programactivity.reserveHotel', $hotel->uuid)}}" onclick="if (confirm('Are you sure you want to book?')){return true} else {return false}"><span class="tag tag-azure">confirm</span></a>
                                                        @else
                                                            <a  href="{{route('programactivity.reserveHotel', $hotel->uuid)}}"><span class="tag tag-azure">Undo</span></a>
                                                    @endif

                                                </tr>
                                            </tbody>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane  " id="tab2">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="safari_requests" >
                                            <thead >
                                            <tr>

                                                <th>Requester</th>
                                                <th>Safari number</th>
                                                <th>Date of arrival</th>
                                                <th>Region</th>
                                                <th>Hotel Name</th>
                                                <th >Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($hotels as $key => $hotel)
                                                <tr>
                                                    <th>{{ $hotel->requester }}</th>
                                                    <th>{{ $hotel->safari_number }}</th>
                                                    <th>{{ $hotel->start_date }}</th>
                                                    <th>{{ $hotel->district->region->name }}</th>
                                                    <th>{{ $hotel->name }}</th>
                                                    <th>
                                                        @if($hotel->reserved == false)
                                                            <a href="{{route('safari.reserveHotel', $hotel->uuid)}}" onclick="if (confirm('Are you sure you want to book?')){return true} else {return false}"><span class="tag tag-azure">confirm</span></a>
                                                        @else
                                                            <a  href="{{route('safari.reserveHotel', $hotel->uuid)}}"><span class="tag tag-azure">Undo</span></a>
                                                        @endif

                                                </tr>
                                            </tbody>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tab3">
                                    <p>over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
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
