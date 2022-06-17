@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attendance</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="attendance" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>

                            <th >Date</th>
                            <th >Checkin Time</th>
                            <th>Checkout Time</th>
                            <th >Checkin Location</th>
                            <th >Checkout Location</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendance as $attendances)
                            <tr>

                                <td>{{date('D d-M-Y', strtotime($attendances->created_at))}}</td>
                                <td>{{date('h:i:s', strtotime($attendances->checkin_time)) }}</td>
                                <td>@if($attendances->checkout_time != null){{date('h:i:s', strtotime($attendances->checkout_time))}}@endif</td>
                                <td>{{$attendances->checkin_location}}</td>
                                <td>{{$attendances->checkout_location}}</td>

                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#attendance").dataTable()
        })
    </script>

@endpush
@endsection
