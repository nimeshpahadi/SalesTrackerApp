<div class="col-md-6 ">
    <div class="panel panel-info">
        <div class="panel-heading" align="center"> <h4>{{strtoupper($add['type'])}}</h4>
            <div class="col-md-offset-11">
                @if($add['type']=='Billing')
                <a class="btn btn-primary" href="{{route('edit_distributor_address', ["id"=>$add['id'],'type'=>1])}}">Edit</a>
                    @else
                    <a class="btn btn-primary" href="{{route('edit_distributor_address', ["id"=>$add['id'],'type'=>2])}}">Edit</a>
                @endif
            </div>
        </div>



        <div class="container">

        <div class="row">
            <label class="col-sm-2 ">Zone:</label>
            {{$add['zone']}}
        </div>
        <div class="row">
            <label class="col-sm-2 ">District:</label>
            {{$add['district']}}
        </div>
        <div class="row">
            <label class="col-sm-2 ">City:</label>
            {{$add['city']}}
        </div>
        <div class="row">
            <label class="col-sm-2 ">Phone No.:</label>
            {{$add['phone']}}
        </div>
        <div class="row">
            <label class="col-sm-2 ">Mobile :</label>
            {{$add['mobile']}}
        </div>

    <div class="row">
            <label class="col-sm-2 ">Fax :</label>
        @if($add['fax']!=null)
            {{$add['fax']}}
        @else
       <p>Not Available</p>

        @endif
        </div>

    </div>
    </div>
</div>