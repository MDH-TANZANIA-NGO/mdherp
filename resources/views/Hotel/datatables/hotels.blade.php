@extends('layouts.app')
@section('content')
<!-- Row -->
<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                                <h3 class="card-title"> CONTRACTED HOTELS</h3>

                <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                    <div class="btn-group mb-0">
                        <a href="{{ route('admin.create') }}" class="btn btn-outline-info"> <i class="fa fa-plus mr-2"></i>Add Hotel</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="rawquery" >
                        <thead >
                        <tr>

                            <th>name</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>Remarks</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotels as $key => $hotel)
                            <tr>
                                <th>{{ $hotel->name }}</th>
                                <th>{{ $hotel->district->region->name }}</th>
                                <th>{{ $hotel->district->name }}</th>
                                <th>{{ $hotel->remarks}}</th>
                                <th><a href="{{route('admin.edit', $hotel->uuid)}}" class="btn btn-primary" >edit</a> <a href="{{route('admin.delete', $hotel->uuid)}}" onclick="if (confirm('Are you sure you want to remove?')){return true} else {return false}" class="btn btn-danger" >Remove</a>  </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>
<!--End  Row -->
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#rawquery").dataTable()
        })
    </script>

@endpush




@endsection



