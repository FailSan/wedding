<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Il Matrimonio di C&amp;A</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest_form.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('styles/mobile_guest_form.css') }}"> -->

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_form.js') }}" defer></script>

    </head>
    <body>
        <main>
            <section class="form-container">
                <form class="animation" data-selected="1">
                    <p class="brown">Info Personali</p>
                </form>
                
                <form class="hidden" data-selected="0">
                    <p class="brown">Info Presenza</p>
                </form>
                
                <form class="hidden" data-selected="0">
                    <p class="brown">Info Alimentari</p>
                </form>
                
                <form class="hidden" data-selected="0">
                    <p class="brown">Info Ospiti</p>
                </form>
            </section>

            <section class="form-summary">
                <a href="#" data-action="prev">Prev</a>
                <a href="#" data-action="next">Next</a>
            </section>
        </main>
    </body>
</html>