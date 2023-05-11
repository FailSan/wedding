<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="--section-index: 0; --form-index: 0;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_summary.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest_summary.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_summary.js') }}" defer></script>

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
            
            <p class="brown-heading">{{ __("Riepilogo") }}</p>

            <div class="summary-container">
                <span class="summary-field" data-content="name">
                    <p class="field">{{ __("Nome") }}</p>
                    <p class="value">{{ $guest->name }}</p>
                </span>

                <span class="summary-field" data-content="surname">
                    <p class="field">{{ __("Cognome") }}</p>
                    <p class="value">{{ $guest->surname }}</p>
                </span>

                <span class="summary-field" data-content="church_confirm">
                    <p class="field">{{ __("Presente alla Cerimonia") }}</p>
                    <p class="value">{{ $guest->church_confirm ? ((app()->getLocale() == "it") ? "Si" : "Yes") : "No" }}</p>
                </span>

                <span class="summary-field" data-content="castle_confirm">
                    <p class="field">{{ __("Presente al Ricevimento") }}</p>
                    <p class="value">{{ $guest->castle_confirm ? ((app()->getLocale() == "it") ? "Si" : "Yes") : "No" }}</p>
                </span>

                <span class="summary-field" data-content="diet">
                    <p class="field">{{ __("Dieta") }}</p>
                    <p class="value">{{ $guest->diet }}</p>
                </span>

                <span class="summary-field" data-content="allergies">
                    <p class="field">{{ __("Allergie") }}</p>
                    <p class="value">{{ $guest->allergies }}</p>
                </span>

                <span class="summary-field" data-content="extra">
                    <p class="field">{{ __("Ospiti Extra") }}</p>
                    <p class="value">{{ $guest->guests->count() }} (
                        @foreach($guest->guests as $extra)
                            {{ $extra->name." ".$extra->surname }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                        )
                    </p>
                </span>
            </div>

            <div class="contact-container">
                <p>{{ __("Hai già confermato i tuoi dati.") }}</p>
                <p class="grey-dialog">{{ __("Se dovessi avere necessità di modificare qualcosa, contattaci!") }}
            </div>

            <div class="button-container">
                <a href="/">
                    <button class="cta-button white-button">{{ __("Torna alla Home") }}</button>
                </a>
                <a href="/guest/edit">
                    <button class="cta-button action-button edit-mode">{{ __("Modifica Dati") }}</button>
                </a>
            </div>
            
        </main>
    </body>
</html>

