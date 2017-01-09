@extends('Layout.app')

@section('main-content')

    <div class="panel-body">

        @role((['admin','generalmanager','director']))
        @include('partials.admin')
        @endrole

        @role(('salesmanager'))
        @include('partials.sales_manager')
        @endrole

        @role(('accountmanagersales'))
        @include('partials.marketing_manager')
        @endrole

        @role(('factoryincharge'))
        @include('partials.factory_incharge')
        @endrole

        @role(('salesman'))
        @include('partials.salesman')
        @endrole

    </div>

@endsection