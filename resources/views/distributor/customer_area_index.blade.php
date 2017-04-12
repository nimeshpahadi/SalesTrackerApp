@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box -->

                <div class="box">

                    @role((['admin','salesmanager','accountmanagersales','salesman','director','generalmanager']))
                    <div align="right" class="pad">
                        <a href="{{route('area.create')}}">
                            <span class=" btn btn-success " title="Create Customer Area">Create Customer Area</span>
                        </a>
                    </div>
                    @endrole


                    <div class="box-header">
                        <h3 class="box-title">List of All Customer Area</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>District</th>
                                <th>Area Name</th>
                                <th>Places</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerAreaList as $area)
                                <tr>
                                    <td>{{$area->district}}</td>
                                    <td>{{$area->area_name}}</td>
                                    <td>{{join(",", json_decode($area->places))}}</td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <a href="{{route('area.edit', $area->id)}}">
                                                    <button class="btn btn-lg btn-warning pad" data-toggle="popover" data-trigger="hover"
                                                            data-placement="top" data-content="Edit Customer Area"><i class="fa fa-edit"></i></button>
                                                </a>
                                            </div>

                                            <div class="col-md-8">
                                                {!! Form::open(['method' => 'DELETE','route' => ['area.destroy', $area->id]]) !!}
                                                <button type="submit" class="btn btn-danger glyphicon glyphicon-trash pad"  data-toggle="popover" data-trigger="hover"
                                                        data-placement="top" data-content="Delete the current product"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">

                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>

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