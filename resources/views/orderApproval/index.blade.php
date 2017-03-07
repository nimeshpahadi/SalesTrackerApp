@extends('Layout.app')
@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @role((['accountmanagersales','admin', 'generalmanager', 'director','salesmanager']))
                @include('orderApproval.partials.accountmanagersale')
                @endrole

            </div>
        </div>
    </section>
@endsection