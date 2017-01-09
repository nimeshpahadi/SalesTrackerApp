<div id="admin approval">
    @if(!isset($adminapproval->admin) && isset($salesapproval->salesmanager)
    && $salesapproval->sales_approval!="Rejected"
    && $salesapproval->sales_approval!="On hold")
        @role((['admin', 'generalmanager', 'director']))
        <div style="padding: 5px">
            @role(('admin'))
            <label> Admin : </label>
            @endrole

            @role(('generalmanager'))
            <label> GM : </label>
            @endrole

            @role(('director'))
            <label> Director : </label>
            @endrole
            {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
            {{ Form::hidden('user_id', Auth::user()->id) }}
            {{ Form::hidden('order_id', $orderId->id) }}
            <div class="form-group row">
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.orderApproval');?>
                    <select name="admin_approval" class="form-control" required>
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

        @if(isset($adminapproval->admin) && isset($salesapproval->salesmanager)
                                         && $salesapproval->sales_approval!=null)

            @if($adminapproval->user_name=="admin")
                <label> Admin : </label>
            @endif

            @if($adminapproval->user_name=="generalmanager")
                <label> GM : </label>
            @endif

            @if($adminapproval->user_name=="director")
                <label> Director : </label>
            @endif

            <div> {{$adminapproval->admin_approval}} by
                <a> {{$adminapproval->user_name}}</a>
            </div>
        @endif

    @if(isset($adminapproval->admin) && $adminapproval->admin_approval=='On hold')
        @role((['admin','generalmanager', 'director']))
        <div style="padding: 5px">
            @role(('admin'))
            <h4>Admin:</h4>
            @endrole

            @role(('generalmanager'))
            <h4>GM:</h4>
            @endrole

            @role(('director'))
            <h4>Director:</h4>
            @endrole
            {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
            {{ Form::hidden('user_id', Auth::user()->id) }}
            {{ Form::hidden('order_id', $orderId->id) }}
            <div class="form-group row">
                <div class="col-md-8">
                    <?php $x = Config::get('distributor.orderApproval');?>
                    <select name="admin_approval" class="form-control" required>
                        <option selected="selected" value="" disabled>{{$adminapproval->admin_approval}}
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

        @if(isset($adminapproval->admin) && $adminapproval->admin_approval=='Rejected')
            @role((['admin', 'generalmanager', 'director']))
            <div style="padding: 5px">
                @role(('admin'))
                <h4>Admin:</h4>
                @endrole

                @role(('generalmanager'))
                <h4>GM:</h4>
                @endrole

                @role(('director'))
                <h4>Director:</h4>
                @endrole

                {!! Form::open(array('id'=>'form','route'=>'sales_admin_approval'))!!}
                {{ Form::hidden('user_id', Auth::user()->id) }}
                {{ Form::hidden('order_id', $orderId->id) }}
                <div class="form-group row">
                    <div class="col-md-8">
                        <?php $x = Config::get('distributor.orderApproval');?>
                        <select name="admin_approval" class="form-control" required>
                            <option selected="selected" value="" disabled>{{$adminapproval->admin_approval}}
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