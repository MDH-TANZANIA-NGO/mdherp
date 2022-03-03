<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Items Requested</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead >
                        <tr>

                            <th >Item</th>
                            <th >Quantity</th>
                            <th >Unit Price</th>
                            <th >Total Price</th>


                        </tr>
                        </thead>
                        <tbody>
                        @if(count($training_items) > 0)
                            @foreach($training_items as $items)
                                <tr>

                                    <td>{{$items->title}}</td>
                                    <td>{{$items->unit}}</td>
                                    <td>{{$items->unit_price}}</td>
                                    <td>{{$items->total_amount}}</td>
                                </tr>
                                <td>{{$items->title}}</td>
                                <td>{{$items->unit}}</td>
                                <td>{{$items->unit_price}}</td>
                                <td>{{$items->total_amount}}</td>
                                </tr>

                            @endforeach
                        @else
                            <tr><td colspan="5" style="text-align: center">No Item Requested</td></tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
            <br>



        </div>
    </div>
</div>
