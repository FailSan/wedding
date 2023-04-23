<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Styles -->
        <link rel ="stylesheet" href="{{ asset('styles/main.css') }}">

        <!-- Scripts -->
        @yield('scripts')

    </head>
    <body>
        @include('user.header')

        <main>
            @section('content')
            @show
        </main>
    </body>
</html>