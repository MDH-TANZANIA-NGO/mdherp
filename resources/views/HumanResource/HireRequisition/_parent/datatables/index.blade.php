<div class="card p-4 mb-4">
    <!-- {{ $hireRequisitionJobs }} -->
    <form action="{{route('hirerequisition.submit',$uuid)}}" method="post">
        @csrf
        <div class="card-body">
                <table   class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">TITLE</th>
                        <th class="wd-15p">REGION</th>
                        <th class="wd-15p">DATE REQUIRED</th>
                        <th class="wd-25p"># OF EMPLOYEES</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        @foreach( $hireRequisitionJobs as $key=>$hireRequisitionJob )
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> {{ $hireRequisitionJob->title }} </td>
                            <td> {{ $hireRequisitionJob->regions  }}</td>
                            <td> {{ $hireRequisitionJob->date_required }} </td>
                            <td> {{ $hireRequisitionJob->empoyees_required  }} </td>
                            <td> <a href="#"> View </a> | <a href="#">Edit</a> | <a href="#">Delete</a> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    <button type="submit" name="submit_job_requisition" value="submit" class="btn btn-inline-block btn-azure"> <i class="fa fa-paper-plane"></i> Submit For Approval</button>
                </div>
        </div>
</form>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function () {

            $("#access_processing").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>
@endpush
