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
                                    {{--Salesmanager--}}
                                    <td>{{$list['company_name']}}</td>
                                    <td>{{$list['contact_name']}}</td>
                                    <td>
                                        {{isset($list['approval']['username'])?$list['approval']['username']:"SalesManager"}}
                                        {{isset($list['approval']['display_name'])?"(".$list['approval']['display_name'].")":""}}
                                                                :  {{(isset($list["approval"]["sales_approval"])
                                                                && $list["approval"]["sales_approval"]!=null)
                                                                ?ucfirst($list["approval"]["sales_approval"])
                                                                :"Waiting For Approval"}}

                                        @if(isset($list['approval']['sales_approval']))

                                            <button @if($list['approval']['sales_approval']=='Approved')
                                                    class="btn btn-success glyphicon glyphicon-info-sign"
                                                    @elseif($list['approval']['sales_approval']=='Rejected')
                                                    class="btn btn-danger glyphicon glyphicon-info-sign"
                                                    @else
                                                    class="btn btn-warning glyphicon glyphicon-info-sign"
                                                    @endif
                                                    data-toggle="popover" data-trigger="hover"
                                                    data-content="{{$list['approval']['sale_remark']}}">
                                            </button>
                                        @endif

                                        <br>

                                        {{--Admin--}}
                                        {{isset($list['adminApproval']['username'])?$list['adminApproval']['username']:"Admin"}}
                                        {{isset($list['adminApproval']['display_name'])?"(".$list['adminApproval']['display_name'].")":""}}
                                                                    : {{(isset($list["adminApproval"]["admin_approval"])
                                                                    && $list["adminApproval"]["admin_approval"]!=null)
                                                                    ?ucfirst($list["adminApproval"]["admin_approval"])
                                                                    :"Waiting For Approval"}}

                                        @if(isset($list['approval']['admin_approval']) && $list['approval']['admin_approval']!=null)
                                            <button @if($list['approval']['admin_approval']=='Approved')
                                                    class="btn btn-success glyphicon glyphicon-info-sign"
                                                    @elseif($list['approval']['admin_approval']=='Rejected')
                                                    class="btn btn-danger glyphicon glyphicon-info-sign"
                                                    @else
                                                    class="btn btn-warning glyphicon glyphicon-info-sign"
                                                    @endif
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
                                        @if(isset($list["approval"]["sales_approval"])
                                              && $list["approval"]["sales_approval"]=="Approved")

                                            @if(isset($list["approval"]["admin_approval"])
                                              && $list["approval"]["admin_approval"]=="Approved")

                                                {!! Html::linkRoute('customerAccountApprove', 'Approve',
                                                             array("distributor_id"=>$list['distributor_id'],
                                                                   "approval_status"=> "approved"),
                                                             array('class'=>'btn btn-success btn-block'))
                                                !!}
                                            @endif
                                        @endif
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