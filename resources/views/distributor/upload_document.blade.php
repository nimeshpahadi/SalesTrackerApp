@extends('Layout.app')

@section('main-content')

    <div class="panel-body">

        <div class="col-md-8 col-md-offset-2">

            <div class="col-sm-6">
                <h3>Upload Customer Document</h3>
            </div>

            <div align="right" class=" pad">
                <a class="btn btn-primary" title="Click to View Document"
                   href="{{route("document.show", $customerId->id)}}">View Document</a>
            </div>

            <div class="box box-info pad">

                {!! Form::open(array('route'=>'document.store', 'method'=>'post','enctype'=>'multipart/form-data'))!!}

                {{ Form::hidden('customer_id', $customerId->id) }}

                <div class="form-group{{ $errors->has('document_type') ? ' has-error' : '' }} clearfix">
                    <label for="document_type" class="col-sm-4 control-label">Document Type</label>

                    <div class="col-sm-8">
                        <input id="document_type" type="text" class="form-control" name="document_type"
                               value="{{ old('document_type') }}" required
                               autofocus>

                        @if ($errors->has('document_type'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('document_type') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('document_name') ? ' has-error' : '' }} clearfix">
                    <label for="document_name" class="col-sm-4 control-label">Document Name</label>

                    <div class="col-sm-8">
                        <input id="document_name" type="file" class="form-control" name="document_name"
                               value="{{ old('document_name') }}" required autofocus>
                        @if ($errors->has('document_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('document_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div align="right">
                    {{Form::submit('Create', array('class'=>'btn btn-sm btn-primary ','title'=>'upload customer document'))}}
                    <a type="button" class="btn btn-sm btn-warning" href="/distributor/{{$customerId->id}}">Cancel</a>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endsection