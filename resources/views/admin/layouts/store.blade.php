<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/reset-default-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/normalize.css') }}" rel="stylesheet">
    <style>
        .dark-bg {
            background: #ccc;
        }
        .light-bg {
            background: #fff;
        }
    </style>
    @slot('head') @endslot
</head>
<body>
<div id="app">
    @include('admin.includes.header')
    <div class="main-content">
        @include('admin.includes.left-menu')
        @yield('content')
    </div>
    @slot('scripts')
        <!-- Scripts -->
        <script src="{{ asset('admin-assets/js/app.js') }}" defer></script>
    @endslot
</div>
</body>
</html>
