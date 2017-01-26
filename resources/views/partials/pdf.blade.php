

<div class="row" align="center">
        <div class="col-md-12">
            <div class="box" style="padding: 10px">
                <div class="box-header">
                    <h3 class="box-title">ADVANCE MARKETING PVT. LTD. </h3>
                </div>
                <div class="pad" align="left">
                <div class="row">
                    <label class="col-sm-6 "> Distributor Name:</label>
                  <b>  {{$orderId->distributor_name}}</b>
                </div>
                    <div class="row">
                        <label class="col-sm-6 ">Product type:</label>
                        <b>{{$orderId->subCategory}}</b>
                    </div>
                <div class="row">
                    <label class="col-sm-6 ">Quantity:</label>
                    <b> {{$orderId->quantity}}</b>
                </div>
                <div class="row">
                    <label class="col-sm-6 ">Price:</label>
                    <b> Rs. {{number_format($orderId->price, 2)}}</b>
                </div>

                <div class="row">
                    <label class="col-sm-6 ">Ordered Date:</label>
                    <b> {{$orderId->created_at}}</b>
                </div>
                    <h3>Address</h3>

                    <div class="col-md-5 col-md-offset-3">
                    <div class="row">
                    <label class="col-sm-6 ">Zone:</label>
                        <b>  {{$shipaddress->zone}}</b>
                </div>
                    <div class="row">
                        <label class="col-sm-6 ">District:</label>
                        <b> {{$shipaddress->district}}</b>
                    </div>
                    <div class="row">
                        <label class="col-sm-6 ">City:</label>
                        <b>  {{$shipaddress->city}}</b>
                    </div>
                        <div class="row">
                        <label class="col-sm-6 ">Mobile:</label>
                            <b> {{$shipaddress->mobile}}</b>
                    </div>
                        <div class="row">
                            <label class="col-sm-6 ">Phone:</label>
                            <b> {{$shipaddress->phone}}</b>
                        </div>
                    </div>
                </div>
<br>
<br>


    <table   align="left" style="width:100%">
        @foreach($order_billings as $ob)

        <tr>
            <th>Gross Total:</th>
            <td> Rs. {{number_format($orderId->price * $orderId->quantity, 2)}}</td>
        </tr>
            <tr>
            <th>Discount:</th>
            <td> {{$ob->discount}}%</td>
        </tr>
        <tr>
            <th>VAT:</th>
            <td>{{$ob->vat}}%</td>
        </tr>
        <tr>
            <th> Shipping Charge:</th>
            <td> Rs. {{number_format($ob->shipping_charge, 2)}}</td>
        </tr>
        <tr>
            <th>Grand Total :</th>
            <td> Rs. {{number_format($ob->grand_total, 2)}}</td>
        </tr>
        <tr>
            <th> Bill Created At:</th>
            <td> {{$ob->created_at}}</td>
        </tr>

        @endforeach

    </table>
                    </div>
                    </div>
                    </div>