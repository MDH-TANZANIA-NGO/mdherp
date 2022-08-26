{!! Form::open(['route' => 'activity.import', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
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
<table id="all_projects" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">CODE</th>
        <th class="wd-20p">TITLE</th>
        <th class="wd-20p">DESCRIPTION</th>
        <th class="wd-20p">OUTPUT UNIT</th>
        <th class="wd-20p">SUB PROGRAM</th>
        <th class="wd-20p">PROGRAM AREA</th>
        <th class="wd-20p">PROJECT(S)</th>
        <th class="wd-25p">ACTION</th>
    </tr>
    </thead>
</table>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_projects").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('activity.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'code', name: 'activities.code', searchable: true},
                    { data: 'title', name: 'activities.title', searchable: true},
                    { data: 'description', name: 'activities.description', searchable: true},
                    { data: 'output_unit_title', name: 'output_units.title', searchable: true},
                    { data: 'sub_program_title', name: 'sub_programs.title', searchable: true},
                    { data: 'program_area_title', name: 'program_areas.title', searchable: true},
                    { data: 'project_list', name: 'projects.title', searchable: true},
                    // { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
