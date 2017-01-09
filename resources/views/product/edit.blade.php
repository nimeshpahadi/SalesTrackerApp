@role((['admin', 'salesmanager','accountmanagersales','generalmanager','director']))
@extends('Layout.app')

@section('main-content')

    <div class=" col-md-8 col-md-offset-2">
        <h3>Edit Product</h3>
        <div class="box box-info clearfix ">

            {!! Form::model($product,array('route'=>['product.update',$product->id],'method'=>'PUT','enctype'=>'multipart/form-data' ))!!}
            {{ csrf_field() }}

            <div class="form-group clearfix">
                <label for="category" class="col-sm-4 control-label">Category</label>
                <div class="col-md-8">
                    <?php $x = Config::get('product.category');?>
                    <select name="category" class="form-control">
                        <option selected="selected" value="" disabled>Category</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="sub_category" class="col-sm-4 control-label">Sub-Category</label>
                <div class="col-md-8">
                    <?php $x = Config::get('product.sub_category');?>
                    <select name="sub_category" class="form-control">
                        <option selected="selected" value="" disabled>Sub-Category</option>
                        @foreach($x as $dep)
                            <option value=" {{ $dep}}">
                                {{ $dep  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group clearfix">
                <label for="name" class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    {{ Form::text('name',null,array('class'=>'form-control'))}}
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="code" class="col-sm-4 control-label">Product Code</label>

                <div class="col-sm-8">
                    {{ Form::text('code',null,array('class'=>'form-control'))}}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group clearfix">
                <label for="description" class="col-sm-4 control-label">Product Description</label>
                <div class="col-sm-8">
                    {{ Form::text('description',null,array('class'=>'form-control'))}}
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="price" class="col-sm-4 control-label">Product Price</label>
                <div class="col-sm-8">
                    {{ Form::text('price',null,array('class'=>'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                    {{ Form::file('image',null,array('class'=>'form-control', 'name'=>"image", 'id'=>"image" ))}}

                </div>
            </div>


            <div class="clearfix"></div>
            {{Form::submit('Save Changes', array('class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px;'))}}
            <a type="button" class="btn btn-warning btn-block" href="/product">Cancel</a>
            {!! Form::close() !!}


        </div>

    </div>
@endsection
@endrole