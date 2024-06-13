<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @include('includes.css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('includes.header')
        @include('includes.sidebar')
        @yield('content')
    </div>

    @include('includes.js')
</body>



</html>
