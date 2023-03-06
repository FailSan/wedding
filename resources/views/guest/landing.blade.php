<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Il Matrimonio di C&amp;A</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_login.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest_login.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_login.js') }}" defer></script>

    </head>
    <body>

        <main>

            <div class="left">
                <img src="{{ Storage::url('images/logo.svg') }}">
                <p class="big">Chiara</p>
                <p class="big">&amp; Aurelio</p>
                <a href="/"><p class="grey">Torna al sito.</p></a>
            </div>

            <div class="right">
                @section('content')
                @show
            </div>

        </main>

    </body>
</html>