@extends('Layout.app')

@section('main-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @role((['accountmanagersales']))
                @include('orderApproval.partials.accountmanagersale')
                @endrole

                @role((['admin', 'generalmanager', 'director']))
                @include('orderApproval.partials.adminview')
                @endrole

                @role((['salesmanager']))
                @include('orderApproval.partials.salesmanview')
                @endrole

            </div>

        </div>

    </section>

@endsection
