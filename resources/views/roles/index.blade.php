@extends('layouts.app')



@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus mr-2"></i></i> Add New
        </a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="40%">Name</th>
                            <th width="40%">Permission</th>
                            <th width="40%">Guard Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->name }}</span>
                                @endforeach
                            </td>
                            <td>{{$role->guard_name}}</td>
                            <td style="display: flex">
                                <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="btn btn-primary m-2">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-2" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

             
            </div>
        </div>
    </div>

</div>


@endsection