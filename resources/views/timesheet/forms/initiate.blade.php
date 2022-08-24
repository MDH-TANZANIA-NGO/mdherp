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

            <form action="{{route('timesheet.store')}}" method="post">

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


                        @foreach(month_days() as $key => $workday)
                        <tr>
                            <td><b>{{ $workday }}</b></td>
                            <input type="hidden" name="data[{{$key}}][date]" value="{{ $workday }}">
                            <td>
                                <input type="number" readonly step=any  name="data[{{$key}}][hours]" class="form-control col-md-4"
                                value="{{ get_working_hours($workday) }}"
                                />
                            </td>
                            <td><input type="text" name="data[{{$key}}][comment]" class="form-control col-md-10"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Submit For Approval</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection