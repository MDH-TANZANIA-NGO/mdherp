
<div class="table-responsive">
    <table id="items" class="table table-striped table-bordered">
        <thead >
        <tr>

            <th >Full name</th>
            <th >Phone</th>
{{--            <th >Requested</th>--}}
            <th >Date</th>
            <th >Time in</th>
            <th >Time Out</th>
            <th >Location</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <td><i class="fa fa-check-circle-o mr-1 text-success"></i>Elinipendo Mziray</td>
            <td>0758698022</td>
{{--            <td>680000</td>--}}
            <td>22-07-2022</td>
            <td>10:30:00 AM</td>
            <td>04:30:00 PM</td>
            <td>Mikocheni Plaza</td>
        </tr>
        <tr>
            <td><i class="fa fa-exclamation-triangle text-warning"></i> Hamis Juma Hamis</td>
            <td>0758698022</td>
{{--            <td>680000</td>--}}
            <td>22-07-2022</td>
            <td>10:30:00 AM</td>
            <td>04:30:00 PM</td>
            <td>Mikocheni Plaza</td>
        </tr>
        <tr>
            <td><i class="fa fa-exchange text-cyan"></i> Noel Kayogoma</td>
            <td>0758698022</td>
{{--            <td>680000</td>--}}
            <td>22-07-2022</td>
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
