<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="--section-index: 0; --form-index: 0;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __("Il Matrimonio di C&A") }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_form.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest_form.css') }}">

        <!-- Scripts -->
        <script type="module" src="{{ asset('scripts/desktop_guest_form.js') }}" defer></script>

    </head>
    <body>
        <div class="loader">
            <img src="{{ Storage::url('images/rings-loader.svg') }}">
        </div>
        
        <main>
            <section class="sidebar">
                <a href="/guest"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

                <span class="language">
                    <p data-lang="it" @class(["selected" => app()->getLocale() == "it"])><a href="/lang/it">IT</a></p>
                    <p>\</p>
                    <p data-lang="en" @class(["selected" => app()->getLocale() == "en"])><a href="/lang/en">EN</a></p>
                </span>

                <div class="percentage"></div>
            </section>

            <section class="form-intro" data-section-sel="1">
                @include('guest.form.intro')
            </section>
            
            <section class="form-feed" data-section-sel="0">
                <div class="form-container">
                    @include('guest.form.name')
                    @include('guest.form.surname')
                    @include('guest.form.church')
                    @include('guest.form.castle')
                    @include('guest.form.diet')
                    @include('guest.form.allergies')
                    @include('guest.form.extra-confirm')
                    @include('guest.form.extra-guests')
                </div>

                <div class="form-sidebar">
                    @include('guest.form.side')
                </div>
            </section>

            <section class="form-summary" data-section-sel="0">
                @include('guest.form.summary')
            </section>

            <nav class="hidden">
                <img data-action="prev" src="{{ Storage::url('images/up-arrow.svg') }}">
                <img data-action="next" src="{{ Storage::url('images/down-arrow.svg') }}">
            </nav>

        </main>
    </body>
</html>