<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ASTS | Advance Sales Tracking System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
{!! Html::style('css/bootstrap.min.css') !!}
<!-- Font Awesome -->
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') !!}
<!-- Ionicons -->
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') !!}
<!-- Theme style -->
{!! Html::style('dist/css/AdminLTE.min.css') !!}
{!!Html::style('dist/plugins/iCheck/all.css') !!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
{!! Html::style('dist/css/_all-skins.min.css') !!}
<!-- iCheck -->
    {!! Html::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') !!}
    {!! Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
    <![endif]-->

    <!-- DataTables -->
    {!! Html::style('/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('/plugins/datatables/dataTables.bootstrap.min.css') !!}
    {!! Html::style('/plugins/datatables/responsive.bootstrap.min.css') !!}
    {{--leaflet--}}
    {!! Html::style('/leaflet/leaflet.css') !!}
    {!! Html::style('/css/custom.css') !!}

    {{--datepicker--}}
    {!! Html::style('/plugins/daterangepicker/daterangepicker.css') !!}



    <script>
        var app_url = "{{Request::root()}}";
    </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>G</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Advance</b>Group</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{Auth::user()->roles[0]->name}} : {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>

                                {!! Html::linkRoute('password','change password',array( Auth::user()->id),array('class'=>''))!!}


                            </li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                    </li>


                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-home"></i> <span>Home</span>

                    </a>

                </li>


                @role((['admin','salesmanager','director','generalmanager']))
                <li class="active treeview">
                    <a href="{{ url('/user') }}">
                        <i class="fa fa-user"></i> <span>User</span>

                    </a>
                </li>
                @endrole

                @role((['admin','salesmanager', 'director','generalmanager','salesman','factoryincharge','account']))
                <li class="active treeview">
                    <a href="{{ url('/distributor') }}">
                        <i class="fa fa-user"></i> <span>Customer</span>
                    </a>
                </li>
                @endrole


                @role(('salesmanager'))
                <li class="active treeview">
                    <a href="{{ url('customer/list') }}">
                        <i class="fa fa-angle-left"></i> <span>Customer Approval</span>
                    </a>
                </li>
                @endrole

                @role((['admin', 'generalmanager', 'director']))
                <li class="active treeview">
                    <a href="{{ url('customer/admin/list') }}">
                        <i class="fa fa-angle-left"></i> <span>Customer Approval</span>
                    </a>
                </li>
                @endrole

                @role(('account'))
                <li class="active treeview">
                    <a href="{{ url('customer/account/list') }}">
                        <i class="fa fa-angle-left"></i> <span>Customer Approval</span>
                    </a>
                </li>
                @endrole

                @role((['admin','salesmanager','accountmanagersales', 'director','generalmanager','salesman']))
                <li class="active treeview">
                    <a href="{{ url('/order') }}">
                        <i class="fa fa-shopping-cart"></i> <span>Order</span>
                    </a>
                </li>
                @endrole

                @role((['admin','salesmanager','accountmanagersales', 'director','generalmanager']))
                <li class="active treeview">
                    <a href="{{ url('/orderApproval') }}">
                        <i class="fa fa-angle-left"></i> <span>Order Approval</span>
                    </a>
                </li>
                @endrole

                @role((['admin','salesmanager','director','generalmanager','salesman']))
                <li class="active treeview">
                    <a href="{{ url('/product') }}">
                        <i class="fa fa-briefcase"></i> <span>Product</span>
                    </a>
                </li>
                @endrole

                @role((['admin', 'marketingmanager', 'salesmanager', 'factoryincharge']))
                <li class="active treeview">
                    <a href="{{ url('/stock') }}">
                        <i class="fa fa-book"></i> <span>Inventory</span>
                    </a>
                </li>
                @endrole

            </ul>
        </section>

    </aside>

