@extends('Layout.app')

@section('main-content')


    <div class="tab-content">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box" style="padding: 10px">
                        @role((['admin','generalmanager','director']))
                        <div align="right" style="padding: 10px">
                            <a href="{{route('product.create')}}">
                                <span class=" btn btn-success glyphicon glyphicon-plus">Create Product</span>
                            </a>
                        </div>
                        @endrole
                        <div class="box-header">
                            <h3 class="box-title">List of Products</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">

                            <table id="example1"
                                   class="table table-striped table-bordered dt-responsive  table-responsive "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sub-Category Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Price</th>


                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($data))
                                @foreach($data as $row)
                                    <tr>
                                        <td><img width="200px" height="80px" src="/images/{{ $row->image }}"></td>

                                        <td>{{$row->name }}</td>
                                        <td>{{$row->category }}</td>
                                        <td>{{$row->sub_category }}</td>
                                        <td>{{$row->code }}</td>
                                        <td>{{$row->description }}</td>
                                        <td>{{$row->price }}/pack
                                            @role((['admin','salesmanager','accountmanagersales','generalmanager','director']))
                                            <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#price{{$row->id}}">Change price
                                            </button>




                                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                             id="price{{$row->id}}" aria-labelledby="myLargeModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">

                                                    {!! Form::model($row,array('route'=>['change_price',$row->id],'method'=>'PUT' ))!!}
                                                    <h3> Edit price</h3>
                                                    <div class="form-group ">
                                                        <label for="price" class="col-sm-4 control-label">Edit Product
                                                            Price</label>
                                                        <div class="col-sm-8">
                                                            {{ Form::text('price',null,array('class'=>'form-control'))}}
                                                        </div>
                                                    </div>

                                                    {{Form::submit('Save Changes', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
                                                    <a type="button" class="btn btn-warning btn-block" href="/product">Cancel</a>
                                                    {!! Form::close() !!}

                                                </div>
                                            </div>
                                        </div>

                                        </td>
                                        <td>
                                            <a href="{{route('product.edit',$row->id)}}">
                                                <button class="btn btn-warning" data-toggle="popover" data-trigger="hover"
                                                        data-placement="top" data-content="Edit"><i class="fa fa-edit"  ></i></button>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id]]) !!}
                                            <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"  data-toggle="popover" data-trigger="hover"
                                                    data-placement="top" data-content="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">

                                            </button>
                                            {!! Form::close() !!}


                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                    @endif



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
    </div>
    <!-- /.content-wrapper -->









@endsection







