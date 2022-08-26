@extends('layouts.app')

@section('content')
{!! Form::open(['route' => 'activity.importBudget', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Bulk Activities Registration</span>
            </div>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="dropify">
                    <div class="row" style="margin-left: 43%">
                        <br>
                    </div>
                    <button class="btn btn-info" style="margin-left: 43%"><i class="fe fe-upload mr-2"></i>Upload Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
    @include('budget.budget.forms.create')
    @include('budget.budget.datatables.all')
@endsection

