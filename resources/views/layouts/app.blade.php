<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@stack('title','Backend')</title>

    <link rel="stylesheet" href="{{asset('/css/libs/material-cons.css')}}">
    <link rel="stylesheet" href="{{asset('/css/libs/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap/bootstrap.css')}}">
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="costume-menu-logout dropdown-toggle" type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {{--                                    <a class="dropdown-item" href="#">Action</a>--}}
                                    {{--                                    <a class="dropdown-item" href="#">Another action</a>--}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script type="text/javascript" src="{{asset('/js/jquery-3.5.1.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui.js')}}" ></script>
<script type="text/javascript" src="{{asset('/js/libs/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/bootstrap/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/libs/jquery-confirm.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/client.js')}}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5ecb9940c75cbf1769ef14a5/1e97r2a1f';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
