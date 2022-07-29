
<div class="table-responsive">
    <table id="items" class="table table-striped table-bordered">
        <thead >
        <tr>

            <th >Full name</th>
            <th >Type</th>
            <th >Phone</th>
            <th >Requested</th>
            <th >Paid</th>
            <th >Time in</th>
            <th >Time Out</th>
            <th >Location</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <td><i class="fa fa-check mr-1 text-success"></i>Elinipendo Mziray</td>
            <td>mdh staff</td>
            <td>0758698022</td>
            <td>680000</td>
            <td>380000</td>
            <td>10:30:00 AM</td>
            <td>04:30:00 PM</td>
            <td>Mikocheni Plaza</td>
        </tr>

        </tbody>
    </table>
</div>
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#items").dataTable()
        })
    </script>

@endpush
