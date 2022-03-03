<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SAFARI ADVANCE SUMMARY</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Scope</h5>
                    </div>
                    <p class="mb-1">{!! html_entity_decode($safari->scope) !!}</p>
                </a>

            </div>

            <hr>


            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Destination</th>
                        <th>Start Date</th>
                        <th>Return Date</th>
                        <th>Perdiem</th>
                        <th>Accommodation</th>
                        <th>Transport</th>
                        <th> Means</th>
                        <th>On Transit</th>
                        <th>Others</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>{{$safari->travellingCost->district->name}}</td>
                        <td>{{$safari_details->from}}</td>
                        <td>{{$safari_details->to}}</td>
                        <td>{{number_2_format($safari_details->perdiem)}}</td>
                        <td>{{number_2_format($safari_details->accommodation)}}</td>
                        <td>{{number_2_format($safari_details->transportation)}}</td>
                        <td>{{$safari_details->transport_means}}</td>
                        <td>{{number_2_format($safari_details->ontransit)}}</td>
                        <td>{{number_2_format($safari_details->other_costs)}}</td>
                        <td>{{number_2_format($safari->travellingCost->total_amount)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
