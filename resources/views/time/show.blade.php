@extends('layouts.app')
@section('content')


<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    




        <div class="row">
            <div class="col-md-4">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Time </h5>
                        <div class="punch-det">
                            <h6>{{$current}}</h6>
                            <p>{{date_format($current, ' l jS F Y')}}</p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <span>{{date_format($current, ' h:i:s A')}}</span>
                            </div>
                        </div>

                        @if ($check->count() == 0)
                        <form action="{{route('store-time')}}" method="POST">
                            @csrf
                            <div class="punch-btn-section">
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                <button type="submit" onclick="sweetalertclick1()" class="btn btn-success punch-btn">Punch In</button>
                            </div>
                        </form>
                        @else
                        <form action="{{route('update-time')}}" method="POST">
                            @csrf
                            <div class="punch-btn-section">
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                <button type="submit" onclick="sweetalertclick2()" class="btn btn-primary punch-btn">Punch Out</button>
                            </div>
                        </form>

                        @endif



                    </div>

                </div>
            </div>

            &nbsp;

            <div class="col-md-4">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Activity</h5>
                        <ul class="res-activity-list">
                            @foreach($times as $data)

                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    {{$data->time_start}}
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    {{$data->time_end}}
                                </p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="tab-pane" id="tab6">

            <div class="card-body">
                <div class="table-responsive">
                    <table id="123" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Start time</th>
                                <th class="wd-15p">End Time</th>
                                <th class="wd-15p">User</th>
                                <th class="wd-15p">Production</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($times as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->time_start}}</td>
                                <td>{{$data->time_end}}</td>
                                <td>{{ access()->user()->full_name_formatted }}</td>
                                <td>
                                    <?php
                                    $start = $data->time_start;
                                    $end = $data->time_end;
                                    $time1 = new DateTime($start);
                                    $time2 = new DateTime($end);
                                    $interval = $time1->diff($time2);
                                    $calc = $interval->format('%i min');
                                    echo $calc;
                                    ?>
                                </td>
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


<script>
    function sweetalertclick1() {
        swal("You're Checked In Successfully ", "", "success");
    }
</script>

<script>
    function sweetalertclick2() {
        swal("You're Checked Out Successfully ", "", "success");
    }
</script>

<style>
    .punch-det {
        background-color: #f9f9f9;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        margin-bottom: 20px;
        padding: 10px 15px;
    }

    .punch-det h6 {
        line-height: 20px;
        margin-bottom: 0;
    }

    .punch-det p {
        color: #727272;
        font-size: 14px;
        margin-bottom: 0;
    }

    .punch-info {
        margin-bottom: 20px;
    }

    .punch-hours {
        align-items: center;
        background-color: #f9f9f9;
        border: 5px solid #e3e3e3;
        border-radius: 50%;
        display: flex;
        font-size: 18px;
        height: 120px;
        justify-content: center;
        margin: 0 auto;
        width: 120px;
    }

    .punch-btn-section {
        margin-bottom: 20px;
        text-align: center;
    }

    .punch-btn {
        border-radius: 5px;
        font-size: 18px;
    
        max-width: 100%;
        padding: 4px 5px;
    }

    .punch-status .stats-box {
        margin-bottom: 0;
    }


    .card-title {
        color: #1f1f1f;
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .recent-activity .res-activity-list {
        height: 328px;
        list-style-type: none;
        margin-bottom: 0;
        overflow-y: auto;
        padding-left: 30px;
        position: relative;
    }

    .recent-activity .res-activity-list li {
        margin-bottom: 15px;
        position: relative;
    }

    .recent-activity .res-activity-list li:last-child {
        margin-bottom: 0;
    }

    .recent-activity .res-activity-list li:before {
        width: 10px;
        height: 10px;
        left: -30px;
        top: 0px;
        border: 2px solid #f43b48;
        margin-right: 15px;
        z-index: 2;
        background: #fff;
    }

    .recent-activity .res-activity-list li:before {
        content: "";
        position: absolute;
        border-radius: 100%;
    }

    .recent-activity .res-activity-list:after {
        content: "";
        border: 1px solid #e5e5e5;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 4px;
    }
</style>

@endsection