<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_login.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest_login.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_login.js') }}" defer></script>

    </head>
    <body>

        <div class="modal-loading">
            <img src="{{ Storage::url('images/rings-loader.svg') }}">
        </div>

        <nav class="sidebar">
            <a href="/guest"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

            <span class="language">
                <p data-lang="it" @class(["selected" => app()->getLocale() == "it"])><a href="/lang/it">IT</a></p>
                <p>\</p>
                <p data-lang="en" @class(["selected" => app()->getLocale() == "en"])><a href="/lang/en">EN</a></p>
            </span>
        </nav>

        <main>

            <section class="left">
                <span class="mid-title">
                    <p class="main-title">Chiara</p>
                    <p class="main-title">&amp; Aurelio</p>
                </span>

                <a href="/">
                    <button class="cta-button white-button">
                        {{ __("Torna alla Home") }}
                    </button>
                </a>
            </section>

            <section class="right">
                <p class="brown-heading">{{ __("Area Invitati") }}</p>

                <span class="mid-label">
                    <p class="question">{{ __("Sei un invitato?") }}</p>
                    <p>{{ __("Inserisci il tuo nome e cognome e il codice che ti è stato inviato via messaggio.
                    Potrai cosi fornirci alcuni dettagli che ci serviranno per organizzare al meglio l'evento.") }}</p>
                </span>

                <form action="#" method="post" id="guest-login">
                    @csrf

                    <label class="text-label">
                        <p>{{ __("Nome") }}</p>
                        <input type="text" id="guest_name" name="guest_name" placeholder=" ">
                    </label>
                    
                    <label class="text-label">
                        <p>{{ __("Cognome") }}</p>
                        <input type="text" id="guest_surname" name="guest_surname" placeholder=" ">
                    </label>

                    <label class="text-label">
                        <p>{{ __("Password") }}</p>
                        <input type="text" id="guest_password" name="guest_password" placeholder=" ">
                    </label>

                    <span class="error-dialog hidden"></span>
                    
                    <input class="cta-button input-button" type="submit" value="{{ __('Accedi') }}">
                </form>
            </section>

        </main>

    </body>
</html>