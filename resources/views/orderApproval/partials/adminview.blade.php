<div class="box">

    <div class="box-header">
        <h3 class="box-title">Order History</h3>
    </div>

</div>

<div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive ">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>

                <th>Distributor</th>
                <th>Salesman</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Order Date</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orderadmin as $o)
                <tr>

                    <td><a href="{{route('distributor.show',$o->distributor_id)}}">{{$o->distributor_name}}</a></td>
                    <td>{{$o->userName}}</td>
                    <td><a href="{{route('product.index')}}">{{$o->subCategory}}</a></td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->price}}</td>
                    <td>{{$o->created_at}}</td>
                    <td>
                        <a href="{{route('order.show',$o->id)}}">
                            <button class="btn btn-sm btn-success" title="View the order for approval">View</button>
                        </a>

                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>


</div>