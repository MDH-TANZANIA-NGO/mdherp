<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payments</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table id="payment_table" class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Full name</th>
                                <th>Phone</th>
                                <th>Days</th>
                                <th>Perdiem</th>
                                <th>Transportation</th>
                                <th>Others</th>
                                <th>Amount Requested</th>
                                <th>Amount Paid</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i></button></td>
                                <td>Elinipendo Mziray</td>
                                <td>0758698022</td>
                                <td>0/10</td>
                                <td>600,000</td>
                                <td>20,000</td>
                                <td>0</td>
                                <td>620,000</td>
                                <td><input type="number" class="form-control" name="amount_paid" value="50000"></td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Swap participant"><i class="fa fa-exchange"></i></a> | <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove participant"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>

                            <tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordian-body collapse" id="demo1">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>Hotspot</th>
                                                <th>Date</th>
                                                <th>Time in</th>
                                                <th>Time out</th>
                                                <th>Checkin location</th>
                                                <th>Checkout location</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                                <td> <a href="#">Juliana Pub</a></td>
                                                <td>30th August 2022</td>
                                                <td>10:30 AM</td>
                                                <td>4:00 PM</td>
                                                <td>Mikocheni A</td>
                                                <td>Mikocheni B</td>
                                            </tr>

                                            <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                                <td> <a href="#">Juliana Pub</a></td>
                                                <td>30th August 2022</td>
                                                <td>10:30 AM</td>
                                                <td>4:00 PM</td>
                                                <td>Mikocheni A</td>
                                                <td>Mikocheni B</td>
                                            </tr>


                                            </tbody>
                                        </table>

                                    </div>
                                </td>
                            </tr>



                            <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i></button></td>
                                <td>Elinipendo Mziray</td>
                                <td>0758698022</td>
                                <td>0/10</td>
                                <td>600,000</td>
                                <td>20,000</td>
                                <td>0</td>
                                <td>620,000</td>
                                <td><input type="number" class="form-control" name="amount_paid" value="50000"></td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Swap participant"><i class="fa fa-exchange"></i></a> | <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove participant"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>
                            <tr>
                                <td colspan="11" class="hiddenRow"><div id="demo2" class="accordian-body collapse">No attendance available</div></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>


</div>

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#payment_table").dataTable({
                pagingType: 'full_numbers',
            })

        })

        </script>
@endpush


