@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => ['timesheet.update', $timesheet], 'method' => 'put']) !!}

    @csrf
    <!-- Large Modal -->

    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Edit Timesheet</span>
            </div>

            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>

        <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th>Date</th>
                            <th>Hours</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($timesheet->attendances as  $key => $attendance)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($attendance->date)->format('d/m/Y')}}</td>
                                    <input type="hidden" name="data[{{$key}}][date]" value="{{$attendance->date }}">
                                    <td><input type="number" step=any name="data[{{$key}}][hrs]" value="{{$attendance->hrs}}" class="form-control col-md-4"></td>
                                    <td><input type="text" name="data[{{$key}}][comment]" value="{{$attendance->comments}}" class="form-control col-md-10"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>

            &nbsp
            &nbsp;
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-azure"> Update Timesheet</button>
                    </div>
                </div>

            </div>
    </div>

    <!-- End Row -->
    {!! Form::close() !!}
@endsection
