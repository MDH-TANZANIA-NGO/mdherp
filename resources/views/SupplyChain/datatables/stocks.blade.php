<div class="card-body p-6">
    <div class="panel panel-primary">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#tab6" data-toggle="tab" class="active">Received <span class="badge badge-primary">5</span></a></li>
                    <li><a href="#tab6" data-toggle="tab" class="">Confirmed <span class="badge badge-success">4</span></a></li>
                    <li><a href="#tab6" data-toggle="tab" class="">Waiting Confirmation <span class="badge badge-warning">1</span></a></li>
                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="{{route('stock.create')}}"> <i class="fa fa-plus mr-2"></i>New Stocks</a>
                </div>
            </div>

        </div>
        <div class="panel-body tabs-menu-body">
            <div class="tab-content">

                <div class="tab-pane active" id="tab6">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="received_stocks" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">EXPENCE ID</th>
                                    <th class="wd-15p">ITEM NAME</th>
                                    <th class="wd-20p">QUANTITY</th>
                                    <th class="wd-25p">DATE RECEIVED</th>
                                    <th class="wd-25p">ACTION</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#received_stocks").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{route('stock.datatable.all')}}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'expense_id', name: 'stocks.expense_id', searchable: true},
                    { data: 'title', name: 'stocks.title', searchable: true},
                    { data: 'quantity', name: 'stocks.quantity', searchable: true},
                    { data: 'date_received', name: 'stocks.date_received', searchable: true},
                    { data: 'action', name: 'action', searchable: false },
                ]
            });
        })
    </script>
@endpush
