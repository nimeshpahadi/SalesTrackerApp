@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box -->

                <div class="box">

                    <div class="box-body table-responsive ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Contact(s)</th>
                                <th>Address</th>
                                <th>email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($distributor as $dis)
                                <tr>
                                    <td>{{$dis->company_name}}</td>
                                    <td>{{$dis->contact_name}}</td>
                                    <td>Ph:{{$dis->phone}}<br>Mob:{{$dis->mobile}}</td>
                                    <td>Zone:{{$dis->zone}}<br>Dis:{{$dis->district}}</td>
                                    <td>{{$dis->email}}</td>
                                    <td>
                                        {!! Html::linkRoute('distributor.show','View',
                                                            array($dis->id),
                                                            array('class'=>'btn btn-primary btn-block'))
                                        !!}

                                        {!! Html::linkRoute('status_edit','Approve',
                                                            array("id"=>$dis->id),
                                                            array('class'=>'btn btn-primary btn-block'))
                                        !!}

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