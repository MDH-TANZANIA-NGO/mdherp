@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Timesheet</h3>
                <div class="card-options ">

                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            </div>

            <div class="card-body">

                {{-- @php
                     $today = today();
                     $dates = [];

                     for($i=1; $i < $today->daysInMonth + 1; ++$i) {
                         $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d-F-Y');
                     }
                 @endphp--}}

                @php
                    $workdays = array();
                    $today = today();
                    $type = CAL_GREGORIAN;
                    $month = date('n'); // Month ID, 1 through to 12.
                    $year = date('Y'); // Year in 4 digit 2009 format.
                    $day_count = cal_days_in_month($type, $month, $year); // Get the amount of days

                    //loop through all days
                    for ($i = 1; $i <= $day_count; $i++) {

                            $date = $year.'/'.$month.'/'.$i; //format date
                            $get_name = date('l', strtotime($date)); //get week day
                            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                            //if not a weekend add day to array
                            if($day_name != 'Sun' && $day_name != 'Sat'){
                                $workdays[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('D d-F-Y');
                                $workdays_for_comments[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d-m-Y');

                            }
                            if ($day_name != 'Fri' ){
                                $hours =  6;
                            }

                    }

                    //var_dump($workdays);

                    // look at items in the array uncomment the next line
                       //print_r($workdays);

                @endphp



                <form id="timesheet" name="timesheet-form" action="{{route('timesheet.store')}}" method="post">
                    @csrf
                    <table id="" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th class="wd-15p">Hours</th>
                            <th class="wd-25p">Comment</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($workdays as $key => $workday)
                           <tr>
                               <td><b>{{ $workday }}</b></td>
                                @if(date('D', strtotime($workday)) == 'Fri')
                                   <td><input type="number" step=any min="6" max="6" name="data[{{$key}}][hours]" value="6" disabled class="form-control col-md-4"></td>
                               @else
                                   <td><input type="number" step=any min="6" max="8.5" name="data[{{$key}}][hours]" value="8.5" disabled class="form-control col-md-4"></td>
@endif
                               @if(date('D', strtotime($workday)) == 'Fri')
                                   <input type="number" step=any min="6" max="6" name="data[{{$key}}][hours]" value="6" hidden class="form-control col-md-4">
                               @else
                                  <input type="number" step=any min="6" max="8.5" name="data[{{$key}}][hours]" value="8.5" hidden class="form-control col-md-4">
                               @endif
                                   <input type="hidden" name="data[{{$key}}][date]" value="{{ $workday }}">
                               <td><input type="text" name="data[{{$key}}][comment]" class="form-control col-md-10"></td>
                           </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" id="submit_btn" class="btn btn-outline-info timesheet" style="margin-left:40%;">Submit For Apprl</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("form[name='timesheet-form']").submit(function (){
                $("#submit_btn").attr('disabled',true);
            });
            // $("#submit_btn").click(function (){
            //     $(this).attr('disabled',true);
            // });
        });
    </script>
@endpush

