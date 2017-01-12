
<div class="box">

    <div class="box-header">
        <h3 class="box-title">Order History</h3>
    </div>
    <form method="get" action="{{route('filter_order')}}">
        <div class="row " style="padding-bottom: 5px">
            <label for="from" class="col-sm-1 control-label">From :</label>
            <div class="col-md-2">
                <input id="date" type="text" value="{{$filters['from']}}" class="form-control" name="from">

            </div>
            <label for="from" class="col-md-1 control-label">To :</label>
            <div class="col-md-2">
                <input id="date1" type="text" value="{{$filters['to']}}" class="form-control" name="to">

            </div>




            <div class="form-group clearfix">
                <label for="" class="col-md-1 distributor ">Customer</label>
                <div class="col-md-2">

                    <select name="distributor" class="form-control select2">
                        <option selected="selected" value="" >Choose Customer</option>
                        @foreach($dis as $d)
                            <option value="{{ $d->id}}" @if($d->id==$filters['distributor']) selected @endif>
                                {{ $d->company_name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-primary">
            </div>

        </div>

    </form>

</div>








<div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive ">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>

                <th>Distributor</th>
                <th>Order Taken</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>

            @foreach($order as $o)
                <tr>
                    <td><a href="{{route('distributor.show', $o->distributor_id)}}">{{$o->distributor_name}}</a></td>
                    <td>{{$o->userName}}</td>
                    <td><a href="{{route('product.index')}}">{{$o->subCategory}}</td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->created_at}}</td>
                    <td>
                        <a href="{{route('order.show',$o->id)}}">
                            <button class="btn btn-success"><i class=""></i>View</button>
                        </a>
                        @foreach($undispatched as $undis)
                            @if($o->id == $undis->id)
                                On Hold
                            @else

                            @endif

                        @endforeach


                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>


</div>