
@extends('layouts.app')

@section('content')
    <div class="row row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Brief Report for Activity No: </h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <textarea class="content" name="example"></textarea>
                </div>
            </div>
            <button class="btn btn-outline-info">Submit For Approval</button>


        </div>
    </div>

    </div>
    </div><!-- end app-content-->

@endsection
