<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@stack('title', __('front.title'))</title>
    <meta name="author" content="Alvaro Trigo Lopez"/>
    <meta name="description" content="fullPage fixed full-screen backgrounds."/>
    <meta name="keywords" content="fullpage,jquery,demo,screen,fixed,fullscreen,backgrounds,full-screen"/>
    <meta name="Resource-type" content="Document"/>
    <meta name="csrf_token" content="{{csrf_token()}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap/bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/fullpage.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/examples.css')}}"/>
    <link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css" />

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/media.css')}}">
</head>
<body>
<div class="loading-append-js loader">
    <h1>Loading ...</h1>
</div>
<div class="app-main-content d-none">
    @yield('content')
</div>
<script src="{{asset('/js/jquery-3.5.1.min.js')}}"></script>
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.min.js"></script>
<script type="text/javascript" src="{{asset('/js/fullpage.js')}}"></script>
<script src="{{asset('/js/index.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/client.js')}}"></script>
@stack('script')
</body>
</html>





