@include('Layout.header')

<div class="content-wrapper">
    <div class="content">
        @include('Layout.notification')
        @yield('main-content')
    </div>
</div>


@include('Layout.footer')