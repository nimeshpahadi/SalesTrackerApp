<div id="salesmanager approval">
    @if(!isset($salesapproval->salesmanager) && isset($marketingapproval->marketingmanager)
    && $marketingapproval->marketing_approval!="Rejected"
    && $marketingapproval->marketing_approval!="On hold")
        @role((['salesmanager']))
        <div style="padding: 5px">
            <h4>Salesmanager:</h4>
            {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
            {{ Form::hidden('user_id', Auth::user()->id) }}
            {{ Form::hidden('order_id', $orderId->id) }}
            <div class="form-group row">
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.orderApproval');?>
                    <select name="sales_approval" class="form-control" required>
                        <option selected="selected" value="" disabled>Choose approval type
                        </option>
                        @foreach($x as $dep)
                            <option value="{{$dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
                {!! Form::close() !!}
            </div>
        </div>
        @endrole
    @endif

        @if(isset($salesapproval->salesmanager) && isset($marketingapproval->marketingmanager)
                                                && $marketingapproval->marketing_approval!=null)
            <label> Salesmanager : </label>
            <div>  {{$salesapproval->sales_approval}} by
                <a>{{$salesapproval->user_name}}</a>
            </div>
        @endif

    @if(isset($salesapproval->salesmanager) && $salesapproval->sales_approval=='On hold')
        @role((['salesmanager']))
        <div style="padding: 5px">
            <h4>Salesmanager:</h4>
            {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
            {{ Form::hidden('user_id', Auth::user()->id) }}
            {{ Form::hidden('order_id', $orderId->id) }}
            <div class="form-group row">
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.orderApproval');?>
                    <select name="sales_approval" class="form-control" required>
                        <option selected="selected" value="" disabled>{{$salesapproval->sales_approval}}
                        </option>
                        @foreach($x as $dep)
                            <option value="{{$dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
                {!! Form::close() !!}
            </div>
        </div>
        @endrole
    @endif

        @if(isset($salesapproval->salesmanager) && $salesapproval->sales_approval=='Rejected')
            @role((['salesmanager']))
            <div style="padding: 5px">
                <h4>Salesmanager:</h4>
                {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
                {{ Form::hidden('user_id', Auth::user()->id) }}
                {{ Form::hidden('order_id', $orderId->id) }}
                <div class="form-group row">
                    <div class="col-md-8">
                        <?php $x = Config::get('distributor.orderApproval');?>
                        <select name="sales_approval" class="form-control" required>
                            <option selected="selected" value="" disabled>{{$salesapproval->sales_approval}}
                            </option>
                            @foreach($x as $dep)
                                <option value="{{$dep}}">
                                    {{ $dep  }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{Form::submit('Submit', array('class'=>'btn btn-primary'))}}
                    {!! Form::close() !!}
                </div>
            </div>
            @endrole
        @endif

</div>
