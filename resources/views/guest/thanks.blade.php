<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="--section-index: 0; --form-index: 0;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_thanks.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest_thanks.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_thanks.js') }}" defer></script>

    </head>
    <body>

        <div class="modal-loading">
            <img src="{{ Storage::url('images/rings-loader.svg') }}">
        </div>

        <nav class="sidebar">
            <a href="/"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

            <span class="language">
                <p data-lang="it" @class(["selected" => app()->getLocale() == "it"])><a href="/lang/it">IT</a></p>
                <p>\</p>
                <p data-lang="en" @class(["selected" => app()->getLocale() == "en"])><a href="/lang/en">EN</a></p>
            </span>

            <div class="percentage"></div>
        </nav>

        <main>
            <span class="hero">
                <p class="main-title">{{ __("Grazie!") }}</p>
                <img src="{{ Storage::url('images/thanks-animation.png') }}">
            </span>

            <p>{{ __("Ci vediamo il 13 Luglio al matrimonio!") }}
                <br>{{ __("Per qualsiasi informazione non esitare a contattarci") }}</p>

            <a href="/">
                <button class="cta-button input-button">
                    {{ __("Torna alla Home") }}
                </button>
            </a>
        </main>
    </body>
</html>