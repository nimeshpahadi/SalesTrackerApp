<div class="box">

    <div class="box-header">
        <h3 class="box-title">Order History</h3>
        @role(('admin'))
        as persalesman
        @endrole
    </div>

    <div class="row " style="padding-bottom: 5px">
        <label for="from" class="col-sm-1 control-label">From:</label>
        <div class="col-md-2">
            <input id="datefield" type="date" class="form-control" name="from">

        </div>
        <label for="from" class="col-md-1 control-label">To:</label>
        <div class="col-md-2">
            <input id="datefield1" type="date" class="form-control" name="to">

        </div>
        <label for="from" class="col-md-1 control-label">Customer</label>
        <div class="col-md-2">
            <input id="distributor" type="text" class="form-control" name="distributor">

        </div>
        <button class="btn-primary btn "> Search</button>

    </div>
</div>
<div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive ">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Product id</th>
                <th>Distributor id</th>
                <th>User id</th>
                <th>Quantity</th>
                <th>Proirity</th>
                <th>Payment term</th>
                <th>Order date</th>
                <th>discount</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($order as $o)
                <tr>
                    <td><a href="{{route('product.index')}}">{{$o->subCategory}}</a></td>
                    <td><a href="{{route('distributor.show',$o->distributor_id)}}">{{$o->distributor_name}}</a></td>
                    <td>{{$o->userName}}</td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->priority}}</td>
                    <td>{{$o->payment_term}}</td>
                    <td>{{$o->created_at}}</td>
                    <td>{{$o->discount}}%</td>
                    <td>


                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
</div>