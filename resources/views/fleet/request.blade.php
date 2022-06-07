@extends('layouts.app')

@section('content')

<form action="{{ route('fleet.store') }}" method="post">

    @csrf

    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Vihecle Request Form</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">


                    <div class="card-body">
                        <div class="row">


                            <input type="text" name="user_id" value="{{access()->user()->id}}" class="form-control" hidden>
                            <input type="text" name="region_id" value="{{access()->user()->region_id}}" class="form-control" hidden>
                            <div class="col-4">
                                <label class="form-label">Date</label>

                                <input type="date" name="date" class="form-control" placeholder="Enter date"><br>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Program</label>

                                <input type="text" name="program" class="form-control" placeholder="Enter program"><br>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Activity Description</label>

                                <input type="text" name="activity_description" class="form-control" placeholder="Enter activity description"><br>
                            </div>


                            <div class="col-4">
                                <label class="form-label">Location</label>

                                <input type="text" name="location" class="form-control" placeholder="Enter location"><br>
                            </div>


                            <div class="col-4">
                                <label class="form-label">Starting Time</label>

                                <input type="time" name="starting_time" class="form-control" placeholder="Enter starting_time"><br>
                            </div>


                            <div class="col-4">

                                <label class="form-label">Ending Time</label>

                                <input type="time" name="ending_time" class="form-control" placeholder="Enter ending_time"><br>
                            </div>


                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Submit for approval</button>

                        </div>
                    </div>

</form>



@endsection