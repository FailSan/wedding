<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="--section-index: 0; --form-index: 0;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Il Matrimonio di C&amp;A</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_thanks.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('styles/mobile_guest_form.css') }}"> -->

    </head>
    <body>
        <main>
            <section class="sidebar">
                <a href="/"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

                <span class="language">
                    <p data-lang="it" class="selected">IT</p>
                    <p>\</p>
                    <p data-lang="en">EN</p>
                </span>

                <div class="percentage"></div>
            </section>

            <section class="thanks">
                <span class="hero">
                    <p>Grazie!</p>
                    <img src="{{ Storage::url('images/thanks.png') }}">
                </span>

                <p>Ci vediamo il 13 Luglio al matrimonio!
                    <br>Per qualsiasi informazione non esitare a contattarci</p>

                <a href="/"><button class="home-button">Torna alla Home</button></a>
            </section>
        </main>
    </body>
</html>