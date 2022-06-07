@extends('layouts.app')

@section('content')


<div class="card-body">
    <div class="panel panel-primary">


         <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                     
                 <ul class="nav panel-tabs">
                    <li class=""><a href="#tab5" class="active" data-toggle="tab"><span class="badge badge-success">{{date_format($current, ' h:i:s A')}},{{date_format($current, ' l jS F Y')}}</span></a></li>
                    

                </ul>
               
                        
                   
                </div>
            </div>

        </div>





    </div>


    <div class="panel-body tabs-menu-body">
        <div class="tab-content">
            <div class="tab-pane active" id="tab5">
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
           

            </div>
        </div>
    </div>
</div>
</div>

</div>
@endsection



















