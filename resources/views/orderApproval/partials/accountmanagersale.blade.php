<div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive ">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>

                <th>Distributor</th>
                <th>Product</th>
                <th>Created By</th>
                <th>Quantity</th>
                <th>Proirity</th>
                <th>Payment Term</th>
                <th>Order Date</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orderA as $o)
                <tr>

                    <td><a href="{{route('distributor.show',$o->distributor_id)}}"> {{$o->distributor_name}}</a></td>
                    <td><a href="{{route('product.index')}}">{{$o->subCategory}}</a></td>
                    <td>{{$o->userName}}</td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->priority}}</td>
                    <td>{{$o->payment_term}}</td>
                    <td>{{$o->created_at}}</td>
                    <td>
                        <a href="{{route('order.show',$o->id)}}">
                            <button class="btn btn-success"><i class="fa fa-money"></i>View</button>
                        </a>

                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
</div>