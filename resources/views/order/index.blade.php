@extends('Layout.app')

@section('main-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                @role((['salesman']))
                 @include('order.partials.salesmanview')
                @endrole
                </div>



                @role((['admin','salesmanager','accountmanagersales','generalmanager','director']))
                  @include('order.partials.salesmanagerview')
                 @endrole

            </div>


    </section>




@endsection
