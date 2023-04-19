<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel ="stylesheet" href="{{ asset('styles/main.css') }}">
        @yield('styles')

        <!-- Scripts -->
        @yield('scripts')

    </head>
    <body>
        @include('user.header')

        <div>@yield('title')</div>

        @section('content')
        @show
        
    </body>
</html>