@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box -->

                <div class="box">

                    <div id="select" class="box-body table-responsive ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Status</th>
                                <th>Remark</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerList as $list)

                                <tr>
                                    <td>{{$list['company_name']}}</td>
                                    <td>{{$list['contact_name']}}</td>
                                    <td>
                                        {{--Salesmanager--}}
                                        {{isset($list['approval']['username'])?$list['approval']['username']:"SalesManager"}}
                                        ({{isset($list['approval']['display_name'])?$list['approval']['display_name']:""}})
                                                                :  {{(isset($list["approval"]["sales_approval"])
                                                                && $list["approval"]["sales_approval"]!=null)
                                                                ?ucfirst($list["approval"]["sales_approval"])
                                                                :"Waiting For Approval"}}

                                        @if(isset($list['approval']['sales_approval'])
                                                 && $list["approval"]["sales_approval"]=="rejected")

                                            <button class="btn btn-danger glyphicon glyphicon-info-sign"
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-content="{{$list['approval']['sale_remark']}}">
                                            </button>
                                        @endif

                                        <br>

                                        {{--Admin--}}
                                        {{isset($list['adminApproval']['username'])?$list['adminApproval']['username']:"Admin"}}
                                        ({{isset($list['adminApproval']['display_name'])?$list['adminApproval']['display_name']:""}})
                                                        :  {{(isset($list["adminApproval"]["admin_approval"])
                                                        && $list["adminApproval"]["admin_approval"]!=null)
                                                        ?ucfirst($list["adminApproval"]["admin_approval"]):"Waiting For Approval"}}


                                        @if(isset($list['approval']['admin_approval'])
                                                 && $list["approval"]["admin_approval"]=="rejected")

                                            <button id="pop" class="btn btn-danger glyphicon glyphicon-info-sign "
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-content="{{$list['approval']['admin_remark']}}">
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        {!! Html::linkRoute('distributor.show','View',
                                                            array($list['distributor_id']),
                                                            array('class'=>'btn btn-primary btn-block'))
                                        !!}

                                        @if(isset($list["approval"]["sales_approval"]))
                                          @if($list["approval"]["sales_approval"]!="approved")

                                            {!! Html::linkRoute('customerApproveUpdate', 'Approve',
                                                                array("distributor_id"=>$list['distributor_id'],
                                                                "sales_approval"=> "approved"),
                                                                array('class'=>'btn btn-success btn-block'))
                                            !!}
                                           @endif


                                        @else
                                            {!! Html::linkRoute('customerApprove', 'Approve',
                                                                array("distributor_id"=>$list['distributor_id'],
                                                                "salesmanager"=> Auth::user()->id,
                                                                "sales_approval"=> "approved"),
                                                                array('class'=>'btn btn-success btn-block'))
                                            !!}

                                            <button class="btn btn-danger btn-block" data-toggle="modal"
                                                    data-target="#reject{{$list['distributor_id']}}">Reject
                                            </button>
                                        @endif

                                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                             id="reject{{$list['distributor_id']}}" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm ">
                                                <div class="modal-content " style="padding: 10px">

                                                    {!! Form::open(array('route' => 'customerReject'))!!}

                                                    {{ Form::hidden('distributor_id', $list['distributor_id']) }}
                                                    {{ Form::hidden('salesmanager', Auth::user()->id) }}
                                                    {{ Form::hidden('sales_approval', "rejected") }}

                                                    <h3>Add Remark</h3>
                                                    <div class="form-group col-md-12">
                                                        {{ Form::textarea('sale_remark', null, ['class' => 'form-control',
                                                                                           'size' => '30x5',
                                                                                           'required' => 'required']) }}
                                                    </div>

                                                    <div align="right" style="padding: 10px">
                                                        {{Form::submit('Save ', array('class'=>'btn btn-primary'))}}
                                                        <a type="button" class="btn btn-warning"
                                                           href="/customer/list">Cancel</a>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection