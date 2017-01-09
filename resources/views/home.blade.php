@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello!!!</div>

                    <div class="panel-body">

                        <h3> Hello User !!</h3>


                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>

                            please login first to use the application
                        @else

                            <a>
                                {{ Auth::user()->username }} you are logged in

                            </a>
                            <li>
                                <a href="/home" style="color: #01ff70;font-size:xx-large"> ENTER HOME</a>

                            </li>

                        @endif

                        @role(('admin'))

                        <p>This is visible to users with the admin role.
                        </p>
                        @endrole

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
