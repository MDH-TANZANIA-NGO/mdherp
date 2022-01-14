@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <h3 class="card-title">Retirement Form</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
{{--                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            {!! Form::open(['route' => ['retirement.update',$retirement]]) !!}
            <div class="card-body">
                @foreach($retire_safari AS $retire_safari)
                <div class="row">

                    <div class="col-md-4" >
                        <div class="form-group">
                            <label class="form-label">Destination</label>
                            <div class="input-group">
                                {!! Form::select('district_id',$district, $retire_safari->district_id, ['class' => 'form-control select2-show-search', 'required', 'disabled']) !!}</td>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <label class="form-label">Travel Date:</label>
                            <input type="date" name="from" value="{{$retire_safari->from}}" class="form-control" disabled>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <label class="form-label">Return Date:</label>
                            <input type="date" name="to" value="{{$retire_safari->to}}" class="form-control" >

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4" >

                <div class="form-group">
                    <label class="form-label">Amount Requested & Approved</label>
                    <div class="input-group">
{{--                        {!! Form::text($retire_safari->amount_requested, ['class' => 'form-control', 'disabled']) !!}--}}
                        <input type="number" name="amount_requested" class="form-control" value="{{$retire_safari->amount_requested}}" disabled>
                    </div>
                </div>
                    </div>

                    <div class="col-md-4" >

                <div class="form-group">
                    <label class="form-label">Amount Paid</label>

                    <input type="number" name="amount_paid" class="form-control" value="{{$retire_safari->amount_paid}}" disabled>



                </div>
                        </div>

                    <div class="col-md-4" >

                        <div class="form-group">
                            <label class="form-label">Amount Received </label>

                            <input type="number" name="amount_received" class="form-control" placeholder="Enter amount you received">

                        </div>
                    </div>

                </div>
                    @endforeach
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label class="form-label">Activity Report <span class="form-label-small">56/100</span></label>
                            <textarea class="form-control" name="activity_report" rows="7" placeholder="Write activity report.."></textarea>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12" >
                <div class="form-group">
                    <div class="form-label">Receipt/Supportive Document Upload</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="example-file-input-custom">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;" >Submit For Approval</button>
                        </div>

                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
