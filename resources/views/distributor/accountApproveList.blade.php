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
                                        SalesManager :  {{(isset($list["approval"]["sales_approval"])
                                                                && $list["approval"]["sales_approval"]!=null)
                                                                ?ucfirst($list["approval"]["sales_approval"])
                                                                :"Not defined"}}

                                        <br>

                                        GM :  {{(isset($list["approval"]["admin_approval"])
                                                        && ($list["approval"]["admin_approval"] !=null))
                                                        ?ucfirst($list["approval"]["admin_approval"])
                                                        :"Not defined"}}

                                    </td>

                                    <td>
                                        {!! Html::linkRoute('distributor.show','View',
                                                            array($list['distributor_id']),
                                                            array('class'=>'btn btn-primary btn-block'))
                                        !!}

                                        @if(isset($list["approval"]["sales_approval"])
                                              && $list["approval"]["sales_approval"]=="approved")

                                            @if(isset($list["approval"]["admin_approval"])
                                              && $list["approval"]["admin_approval"]=="approved")

                                                {!! Html::linkRoute('customerAccountApprove', 'Approve',
                                                             array("distributor_id"=>$list['distributor_id'],
                                                                   "approval_status"=> "approved"),
                                                             array('class'=>'btn btn-primary btn-block'))
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