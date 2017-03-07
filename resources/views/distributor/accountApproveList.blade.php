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
                                        {{isset($list['approval']['username'])?$list['approval']['username']:""}}
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





                                    </td>
                                    <td>
                                        {!! Html::linkRoute('distributor.show','View',
                                                            array($list['distributor_id']),
                                                            array('class'=>'btn btn-primary btn-block'))
                                        !!}
                                        @if(isset($list["approval"]["sales_approval"])
                                              && $list["approval"]["sales_approval"]=="Approved")


                                                {!! Html::linkRoute('customerAccountApprove', 'Approve',
                                                             array("distributor_id"=>$list['distributor_id'],
                                                                   "approval_status"=> "approved"),
                                                             array('class'=>'btn btn-success btn-block'))
                                                !!}
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