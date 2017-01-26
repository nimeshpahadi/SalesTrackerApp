
@role((['admin', 'salesmanager','marketingmanager','generalmanager','director']))
@extends('Layout.app')

@section('main-content')



    <div class="col-md-8 col-md-offset-2 ">

        <h3>Create Product</h3>
    <div class="box box-info clearfix pad ">



        {!! Form::open(array('route'=>'product.store' ,'enctype'=>'multipart/form-data'))!!}
        {{ csrf_field() }}

        <div class="form-group clearfix">
            <label for="category" class="col-sm-4 control-label">Category</label>
            <div class="col-md-8">
                <?php $x = Config::get('product.category');?>
                <select name="category" class="form-control" required>
                    <option selected="selected" disabled>Choose Category</option>
                    @foreach($x as $dep)
                        <option value="{{$dep}}">
                            {{$dep}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="sub_category" class="col-sm-4 control-label">Sub-Category</label>
            <div class="col-md-8">
                <?php $x = Config::get('product.sub_category');?>
                <select name="sub_category" class="form-control" required>
                    <option selected="selected" disabled>Choose Sub-Category</option>
                    @foreach($x as $dep)
                        <option value="{{$dep}}">
                            {{ $dep  }}
                        </option>
                    @endforeach
                 </select>
            </div>
        </div>


        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} clearfix">
            <label for="name" class="col-sm-4 control-label">Name</label>

            <div class="col-sm-8">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                       autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }} clearfix">
            <label for="code" class="col-sm-4 control-label">Code</label>

            <div class="col-sm-8">
                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required
                       autofocus>

                @if ($errors->has('code'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} clearfix">
            <label for="description" class="col-sm-4 control-label">Description</label>

            <div class="col-sm-8">
                <textarea id="description" type="text" class="form-control" name="description"
                          value="{{ old('description') }}" required autofocus>
</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }} clearfix">
            <label for="price" class="col-sm-4 control-label">Price</label>

            <div class="col-sm-8">
                <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required
                       autofocus>

                @if ($errors->has('price'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('warehouse_id') ? ' has-error' : '' }} clearfix">
            <label for="warehouse_id" class="col-sm-4 control-label">Warehouse </label>

            <div class="col-md-8 warehouse">
                <select id="warehouse_id" name="warehouse_id[]"
                        class=" form-control warehouse"  multiple required>


                    @foreach ($ware as $warehouse)
                        <option value="{{$warehouse->id}}">
                            {{$warehouse->name}}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="form-group ">
            <label for="price" class="col-sm-4 control-label">Image</label>
            <div class=" col-sm-8 ">

                    <span class="input-group-addon "><i class="fa fa-file"></i></span>
                <input type="file" class="form-control" name="image" id="image" required autofocus >
                        </div>
        </div>


        <div class="clearfix pad"></div>
        <div align="right" >
        {{Form::submit('Create Product', array('class'=>'btn btn-sm btn-primary ','title'=>'Save the product'))}}
        <a type="button" class="btn btn-sm btn-warning" href="/product">Cancel</a>
        {!! Form::close() !!}
            </div>


    </div>
    </div>


    @endsection
@endrole