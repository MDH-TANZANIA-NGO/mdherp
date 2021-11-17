<table id="equipment_all" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-20p">NAME</th>
         <th class="wd-25p">CATEGORY</th>
         <th class="wd-25p">DESCRIPTION</th>
         <th class="wd-25p">PRICE RANGE</th>
    </tr>
    </thead>
</table>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#equipment_all").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('equipment.datatable.all') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex','bSortable': false, 'aTargets': [0], 'bSearchable': false },
                    { data: 'title', name: 'equipments.title', searchable: true},
                    { data: 'equipment_title', name: 'equipment_types.title', searchable: true},
                    { data: 'specs', name: 'equipment.specs', searchable: true},
                    { data: 'price_range', name: 'price_range', searchable: true},
                ]
            });
        })
    </script>
@endpush
