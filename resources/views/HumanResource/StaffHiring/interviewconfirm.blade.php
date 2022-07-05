@extends('layouts.app2')
@section('content')
    <div class="col-lg-12 col-md-12">
{{--        {!! Form::open(['route' => ['interviewconfirm.update',], 'enctype'=>'multipart/form-data']) !!}--}}
        <div class="card">
    <div class="card-body">
        <div class=" " id="profile-log-switch">
            <div class="fade show active ">
                <div class="row mt-5 profie-img">
                    <div class="col-md-12">
                        <div class="media-heading">
                            <h5><strong>Hi! {{$interview_details->full_name}}</strong></h5>
                        </div>
                        <p>You have been shortlisted for an interview</p>
                        <p>Kindly confirm your availability by pressing a button bellow</p>
                    </div>
                </div>
                <div class="table-responsive border ">
                    <table class="table row table-borderless w-100 m-0 ">
                        <tbody class="col-lg-6 p-0">
                        <tr>
                            <td><strong>Full Name:</strong> {{$interview_details->full_name}} </td>
                        </tr>
                        <tr>
                            <td><strong>Interview Position:</strong> {{$interview_details->interviews->jobRequisition->designation->full_title}}</td>
                        </tr>
                        <tr>
                            <td><strong>Interview Date and Time:</strong> {{$interview_details->interview_date}} </td>
                        </tr>
                        </tbody>
                        <tbody class="col-lg-6 p-0">
                        <tr>
                            <td><strong>Interview Type:</strong> {{$interview_details->interviews->interviewType->name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Take place at:</strong> xxxx</td>
                        </tr>
                        <tr>
                            <td><strong>What to Bring:</strong> xxxx </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="">
                    <div class="btn-list text-center">
                        <a href="{{route('interviewconfirm.update', [$interview_details->id,$interview_details->interview_id])}}" class="btn btn-primary">Comfirm</a>
{{--                        <a href="#" class="btn btn-secondary">Save and continue</a>--}}
                        <a href="#" class="btn btn-danger">Cancel</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
        </div>
{{--        {!! Form::close() !!}--}}
    </div>

@endsection
