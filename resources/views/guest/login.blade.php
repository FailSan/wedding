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
                <p class="brown">Area Invitati</p>

                <span>
                    <p>Sei un invitato?</p>
                    <p class="grey">Dicci come ti chiami per accedere alla tua area personale. Lì
                        potrai fornirci alcuni dettagli che ci serviranno per organizzare al meglio
                        l'evento.</p>
                </span>

                <form action="#" method="post" id="guestLogin">
                    @csrf
                    <input type="text" id="guest_name" name="guest_name" placeholder="Nome">
                    <input type="text" id="guest_surname" name="guest_surname" placeholder="Cognome">
                    <input type="submit" value="Entra">
                </form>

                <span class="dialog"></span>
            </div>

        </main>

    </body>
</html>