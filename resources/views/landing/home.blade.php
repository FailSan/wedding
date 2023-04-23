<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_home.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_home.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_home.js') }}" defer></script>

    </head>
    <body>
        
        <div class="modal-loading">
            <img src="{{ Storage::url('images/rings-loader.svg') }}">
        </div>
        
        <nav class="sidebar">@include('landing.navbar')</nav>

        <a class="fixedRSVP" href="/guest">RSVP</a>

        <section data-content="home" class="pages">@include('landing.hero')</section>

        <section data-content="intro" class="pages">@include('landing.intro')</section>

        <section data-content="when" class="pages">@include('landing.when')</section>

        <section data-content="church" class="pages">@include('landing.church')</section>

        <section data-content="castle" class="pages">@include('landing.castle')</section>

        <section data-content="guest" class="pages">@include('landing.guest')</section>

        <section data-content="present" class="pages">@include('landing.present')</section>

        <section data-content="misc" class="pages">@include('landing.misc')</section>

        <footer class="pages">@include('landing.footer')</footer>

    </body>
</html>