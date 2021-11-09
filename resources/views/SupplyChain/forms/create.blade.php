<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>testing form</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('SupplyChain.create') }}"> Create New Product</a>

        </div>

    </div>

</div>



@if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>

@endif



<table class="table table-bordered">

    <tr>

        <th>No</th>

        <th>Name</th>

        <th>Details</th>



    </tr>

    @foreach ($goods as $goods)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $goods->name }}</td>

            <td>{{ $goods->detail }}</td>



        </tr>

    @endforeach

</table>



{!! $goods->links() !!}
