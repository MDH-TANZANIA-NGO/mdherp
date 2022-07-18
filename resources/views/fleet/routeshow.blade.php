@extends('layouts.app')
@section('content')


<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->






    <div class="tab-pane" id="tab6">

        <div class="card-body">
            <div class="table-responsive">
                <table id="123" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Passanger</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Driving distance</th>
                            <th>Duration</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($intervals as $interval)
                        <tr>
                            <td>{{$interval->id}}</td>
                            <td>{{$interval->user->full_name}}</td>
                            <td>{{$interval->from}}</td>
                            <td>{{$interval->to}}</td>
                            <td>{{$interval->driving_distance}}</td>
                            <td>{{$interval->duration}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>


    </div>
    </table>
</div>
</div>


@endsection