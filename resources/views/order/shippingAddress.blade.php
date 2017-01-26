<div class="col-md-10">
    <div class="panel panel-info">
        <div class="panel-heading " align="center"> <h4>{{strtoupper($shipaddress['type'])}}</h4>
            <div class="col-md-offset-11">
                <a class="btn btn-primary glyphicon glyphicon-edit" title="Edit Shipping Address"
                   href="{{route('edit_distributor_address',["did"=>$shipaddress->distributor_id,"id"=>$shipaddress['id'],'type'=>2])}}"></a>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <label class="col-sm-2 ">Zone:</label>
                {{$shipaddress['zone']}}
            </div>
            <div class="row">
                <label class="col-sm-2 ">District:</label>
                {{$shipaddress['district']}}
            </div>
            <div class="row">
                <label class="col-sm-2 ">City:</label>
                {{$shipaddress['city']}}
            </div>
            <div class="row">
                <label class="col-sm-2 ">Phone No.:</label>
                {{$shipaddress['phone']}}
            </div>
            <div class="row">
                <label class="col-sm-2 ">Mobile :</label>
                {{$shipaddress['mobile']}}
            </div>

            <div class="row">
                <label class="col-sm-2 ">Fax :</label>
                @if($shipaddress['fax']!=null)
                    {{$shipaddress['fax']}}
                @else
                    <p>Not Available</p>

                @endif
            </div>

        </div>
    </div>
</div>