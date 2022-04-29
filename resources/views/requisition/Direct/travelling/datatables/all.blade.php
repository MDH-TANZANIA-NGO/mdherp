<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
{{--                <h3 class="card-title">TRAVELLING COSTS</h3>--}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="rawquery" >
                        <thead >
                        <tr>

                            <th>ID</th>
                            <th>name</th>
                            <th>Days</th>
                            <th>Perdiem</th>
                            <th>Ontransit</th>
                            <th>Accommodation</th>
                            <th>Transport</th>
                            <th>Others</th>
                            <th>Total</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($travelling_costs as $key => $cost)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <th>{{ $cost->user->full_name_formatted }}</th>
                                <th>{{ $cost->no_days }}</th>
                                <th>{{ number_2_format($cost->perdiem_total_amount) }}</th>
                                <th>{{ number_2_format($cost->ontransit) }}</th>
                                <th>{{ number_2_format($cost->accommodation) }}</th>
                                <th>{{ number_2_format($cost->transportation) }}</th>

                                <th>{{ number_2_format($cost->other_cost) }}</th>
                                <th>{{ number_2_format($cost->total_amount) }}</th>
                                <th><a href="{{route('travelling.edit',$cost->uuid)}}" class="btn btn-primary" onclick="if (confirm('Are you sure you want to edit?')){return true} else {return false}"><i class="fa fa-edit"></i></a> <a href="{{route('travelling.delete',$cost->uuid)}}" class="btn btn-danger" onclick="if (confirm('Are you sure you want to delete?')){return true} else {return false}"><i class="fa fa-trash"></i></a> </th>
                            </tr>
                        </tbody>
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


