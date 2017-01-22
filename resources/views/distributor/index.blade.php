@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box -->

                <div class="box">
                    <div align="right " style="padding: 10px">
                        @role((['admin','salesmanager','accountmanagersales','salesman','director','generalmanager']))
                        <a href="{{route('distributor.create')}}">
                            <span class=" btn btn-success " title="Create new customer">Create Customer</span>
                        </a>
                        @endrole
                    </div>

                    <div class="box-header">
                        <h3 class="box-title">List of All Customer</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact(s)</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($distributor as $dis)
                                <tr>
                                    <td>{{$dis->company_name}}</td>
                                    <td>Ph:{{$dis->phone}}<br>Mob:{{$dis->mobile}}</td>
                                    <td>Zone:{{$dis->zone}}<br>Dis:{{$dis->district}}</td>
                                    <td>{{$dis->email}}</td>
                                    <td>
                                        {!! Html::linkRoute('distributor.show',
                                                            'View',array($dis->id),
                                                                   array('class'=>'btn btn-primary ','title'=>"View details of customer {$dis->company_name}"))!!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection