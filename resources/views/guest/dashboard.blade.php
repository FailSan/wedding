<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Il Matrimonio di C&amp;A</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('styles/desktop_guest.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/mobile_guest.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('scripts/desktop_guest_dashboard.js') }}" defer></script>

    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="/guest">Profilo</a></li>
                    <li><a href="/guest/guests">Ospiti</a></li>
                    <li><a href="">Bacheca</a></li>
                </ul>
                <a href="/">Torna al Sito</a>
            </nav>

            <span class="title">
                <p class="big">Benvenuto {{ $guest->name }}</p>
                <p class="mid">&ldquo; Questa è la tua pagina personale. Qui puoi trovare i tuoi dati, aggiornarli
                    e comunicarci chi verrà con te.&rdquo;</p>
            </span>
        </header>

        <main>
            @section('content')
            
            <div>

                <section data-form="basic">

                    <p class="brown">Info Personali</p>

                    <div class="formStatus hidden">
                        <p></p>
                        <img src="{{ Storage::url('images/loading.png') }}">
                    </div>

                    <form action="#" method="post" id="guestBasic">
                        @csrf
                        <label>
                            <p class="label">Nome:</p>
                            <input type="text" id="name" name="name" value="{{ $guest->name }}">
                        </label>

                        <label>
                            <p class="label">Cognome:</p>
                            <input type="text" id="surname" name="surname" value="{{ $guest->surname }}">
                        </label>

                        <span class="dialog hidden"></span>
                        
                        <input type="submit" value="Aggiorna Dati">
                    </form>

                </section>


                <section data-form="food">

                    <p class="brown">Info Alimentari</p>

                    <div class="formStatus hidden">
                        <p></p>
                        <img src="{{ Storage::url('images/loading.png') }}">
                    </div>

                    <form action="#" method="post" id="guestFood">
                        @csrf
                        <p class="description">Dicci qualcosa sul tuo stile alimentare. Qui puoi 
                            comunicarci se sei vegetariano, crudariano o hai qualche problema
                            con alcuni alimenti.</p>
                        <p class="example">(Esempio: onnivoro, vegetariano, non mangio pesce, ecc...)</p>
                        
                        <label>
                            <p class="label">Dieta:</p>
                            <input type="text" id="diet" name="diet" value="{{ $guest->diet }}">
                        </label>

                        <p class="description">Soffri di allergie particolari? Indicacele tutte scrivendo gli allergeni uno dopo
                            l'altro separandoli con una virgola.</p>
                        <p class="example">(Esempio: glutine, lattosio, pesche, aglio, ecc...)</p>
                        
                        <label>
                            <p class="label">Allergie:</p>
                            <input type="text" id="allergies" name="allergies" value="{{ $guest->allergies }}">
                        </label>

                        <span class="dialog hidden"></span>
                        
                        <input type="submit" value="Aggiorna Dati">
                    </form>

                </section>

            </div>

            <div>
                <section data-form="presence">

                    <p class="brown">Info Presenza</p>

                    <div class="formStatus hidden">
                        <p></p>
                        <img src="{{ Storage::url('images/loading.png') }}">
                    </div>

                    <form action="#" method="post" id="guestPresence">
                        @csrf
                        <p class="description">La cerimonia si svolgerà alle 16.30 presso la Chiesa
                            di San Francesco d'Assisi All'Immacolata. Abbiamo bisogno di sapere in
                            anticipo se ci sarai.</p>
                        <p class="example">(Puoi trovare maggiori informazioni riguardo la cerimonia e come
                            raggiungere la Chiesa sul <a href="/">sito ufficiale del matrimonio</a>)</p>
                        <div class="radioLabel">
                            <p class="label">Sarai presente alla Cerimonia?</p>

                            <label>
                                <p>Sì</p>
                                <input type="radio" name="church_confirmed" value="true" @checked($guest->church_confirmed)>
                            </label>

                            <label>
                                <p>No</p>
                                <input type="radio" name="church_confirmed" value="false" @checked(!$guest->church_confirmed)>
                            </label>
                        </div>

                        <p class="description">Il ricevimento si svolgerà alle 19.00 presso il
                            Castello Xirumi di Serravalle. Abbiamo bisogno di sapere in
                            anticipo se ci sarai.</p>
                        <p class="example">(Puoi trovare maggiori informazioni riguardo il ricevimento e come
                            raggiungere il Castello sul <a href="/">sito ufficiale del matrimonio</a>)</p>
                        <div class="radioLabel">
                            <p class="label">Sarai presente al Ricevimento?</p>
                            
                            <label>
                                <p>Sì</p>
                                <input type="radio" name="castle_confirmed" value="true" @checked($guest->castle_confirmed)>
                            </label>

                            <label>
                                <p>No</p>
                                <input type="radio" name="castle_confirmed" value="false" @checked(!$guest->castle_confirmed)>
                            </label>
                        </div>

                        <span class="dialog hidden"></span>

                        <input type="submit" value="Aggiorna Dati">
                    </form>

                </section>


                <section data-form="guests">

                    <p class="brown">Info Invitati</p>

                    <form>
                        <p class="description">Porti qualcuno con te? Aggiungilo agli invitati e
                            comunicaci le sue informazioni principali.</p>
                        <p class="example">Al momento hai <strong>{{ $guest->guests->count() }} @if($guest->guests->count() == 1)Invitato @else Invitati @endif</strong></p>
                        <a class="buttonLike" href="/guest/guests">Vai alla Sezione Dedicata</a>
                    </form>

                </section>

            </div>
            @show
        </main>

    </body>
</html>