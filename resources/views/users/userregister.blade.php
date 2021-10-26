@extends('layouts.app')

@section('content')
    <form class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Activity</label>
                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                            <option label="Choose one">
                            </option>
                            <option value="1">HTS</option>
                            <option value="2">Data Collection</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Fiscal Year</label>
                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                            <option label="Choose one">
                            </option>
                            <option value="1">2012</option>
                            <option value="2">2021</option>
                        </select>
                    </div>
                </div>





                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-label">Output unit</label>
                        <input type="text" placeholder="unit" class="form-control" disabled>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th>Region</th>
                            <th>Amount</th>
                            <th>Numeric Output</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Tabora</td>
                            <td><input type="number" class="form-control" placeholder="Amount"></td>
                            <td><input type="number" class="form-control" placeholder="Numeric Output"></td>
                        </tr>
                        <tr>
                            <td>Geita</td>
                            <td><input type="number" class="form-control" placeholder="Amount"></td>
                            <td><input type="number" class="form-control" placeholder="Numeric Output"></td>
                        </tr>
                        <tr>
                            <td>Dar es salaam</td>
                            <td><input type="number" class="form-control" placeholder="Amount"></td>
                            <td><input type="number" class="form-control" placeholder="Numeric Output"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Submit </button>

            </div>
        </div>

    </form>


    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12" >

                    <div class="table-responsive">
                        <table id="all_projects" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th class="wd-15p">Activity</th>
                                <th class="wd-15p">AMOUNT</th>
                                <th class="wd-20p">REGIONS</th>
                                <th class="wd-15p">FISCAL YEAR</th>
                                <th class="wd-10p">ACTION</th>
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
                                        ajax: '{{ route('project.datatable.all') }}',
                                        columns: [
                                            { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                                            { data: 'code', name: 'projects.code', searchable: true},
                                            { data: 'title', name: 'projects.title', searchable: true},
                                            { data: 'type', name: 'code_values.name', searchable: true},
                                            { data: 'regions_count', name: 'regions_count', searchable: true},
                                            // { data: 'description', name: 'projects.description', searchable: true},
                                            { data: 'start_year', name: 'projects.start_year', searchable: true},
                                            { data: 'end_year', name: 'projects.end_year.', searchable: true },
                                            // { data: {_: 'created_at.display',sort: 'created_at.timestamp'}, name: 'created_at', searchable: false },
                                            { data: 'action', name: 'action', searchable: false },
                                        ]
                                    });
                                })
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

