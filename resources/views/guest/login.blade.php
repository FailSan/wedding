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
            <section class="sidebar">
                <a href="/guest"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

                <span class="language">
                    <p data-lang="it" class="selected">IT</p>
                    <p>\</p>
                    <p data-lang="en">EN</p>
                </span>
            </section>

            <section class="left">
                <span class="mid-title">
                    <p>Chiara</p>
                    <p>&amp; Aurelio</p>
                </span>

                <a class="bot-button" href="/">
                    <button>Torna alla home</button>
                </a>
            </section>

            <section class="right">
                <p class="top-title">Area Invitati</p>

                <span class="mid-label">
                    <p class="question">Sei un invitato?</p>
                    <p>Inserisci il tuo nome e cognome e il codice che ti è stato inviato via messaggio.
                    Potrai cosi fornirci alcuni dettagli che ci serviranno per organizzare al meglio l'evento.</p>
                </span>

                <form action="#" method="post" id="guest-login">
                    @csrf

                    <label class="text-label">
                        <p>Nome</p>
                        <input type="text" id="guest_name" name="guest_name" placeholder=" ">
                    </label>
                    
                    <label class="text-label">
                        <p>Cognome</p>
                        <input type="text" id="guest_surname" name="guest_surname" placeholder=" ">
                    </label>

                    <label class="text-label">
                        <p>Parola d'ordine</p>
                        <input type="text" id="guest_password" name="guest_password" placeholder=" ">
                    </label>

                    <span class="bot-dialog hidden"></span>
                    
                    <input type="submit" value="Accedi">
                </form>
            </section>

        </main>

    </body>
</html>