<table id="all_leaves" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th class="wd-15p">#</th>
        <th class="wd-15p">ORGANISATION</th>
        <th class="wd-20p">POSITION</th>
        <th class="wd-20p">SUMMARY</th>
        <th class="wd-20p">SUPERVISOR</th>
        <th class="wd-15p">START YEAR</th>
        <th class="wd-10p">END YEAR</th>
        <th class="wd-10p">ACTION</th>
    </tr>
    </thead>
</table>
@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#all_leaves").DataTable({
                // processing: true,
                // serverSide: true,
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: "'{{ route('leave.datatable.access.processing') }}'",
                columns: [

                ]
            });
        })
    </script>
@endpush
