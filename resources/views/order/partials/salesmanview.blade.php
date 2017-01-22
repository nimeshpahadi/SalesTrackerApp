<div class="box">

    <div class="box-header">
        <h3 class="box-title">Order History</h3>
        @role(('admin'))
        as per salesman
        @endrole
    </div>

    <form method="get" action="{{route('filter_order')}}">
        <div class="row  pad" >
            <label for="from" class="col-sm-1 control-label">From :</label>
            <div class="col-sm-2">
                <input id="date" type="text" value="{{$filters['from']}}" class="form-control" name="from">

            </div>
            <label for="from" class="col-sm-1 control-label">To :</label>
            <div class="col-sm-2">
                <input id="date1" type="text" value="{{$filters['to']}}" class="form-control" name="to">

            </div>




            <div class="form-group clearfix">
                <label for="" class="col-sm-1 distributor ">Customer</label>
                <div class="col-sm-2">

                    <select name="distributor" class="form-control select2">
                        <option selected="selected" value="" >Choose Customer</option>
                        @foreach($dis as $d)
                            <option value="{{ $d->id}}" @if($d->id==$filters['distributor']) selected @endif>
                                {{ $d->company_name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-sm btn-primary" title="Submit the filters to be appiled">
            </div>

        </div>

    </form>
</div>
<div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive ">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Product Id</th>
                <th>Distributor Id</th>
                <th>User Id</th>
                <th>Quantity</th>
                <th>Proirity</th>
                <th>Payment Term</th>
                <th>Order Date</th>
                <th>Discount</th>
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



{{--salesmanagerview--}}
