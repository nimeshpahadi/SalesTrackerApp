@extends('Layout.app')

@section('main-content')

    <h1 align="center"><a href="/distributor/{{$customerName->id}}">{{$customerName->company_name}}</a></h1>
    <h1 align="right">
        <a class="btn btn-primary" title="Click to Upload Document" href="/customer/{{$customerName->id}}/document">
            Upload Document
        </a>
    </h1>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Document Name</th>
            <th>Document Type</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($customerDocument as $customer)
            <tr>
                <td>
                    <a href="{{asset('storage/customer/')}}/{{$customer->document_name}}" target="_blank">
                        {{$customer->document_name}}
                    </a>
                </td>

                <td>{{$customer->document_type}}</td>

                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['document.destroy', $customer->id]]) !!}

                    <button type="submit" class="btn btn-sm btn-danger"
                            data-toggle="popover"
                            data-trigger="hover"
                            data-placement="top" data-content="Delete Current Document"
                            onclick="return confirm('Are you sure you want to delete this item?');">Delete

                    </button>

                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection