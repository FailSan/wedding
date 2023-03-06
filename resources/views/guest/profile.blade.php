@extends('guest.dashboard')

@section('title', "Profilo Invitato")

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/guest.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('scripts/guestForm.js') }}" defer></script>
@endsection

@section('content')
    @parent

    <section>
        <span class="big_text">Ciao {{ $guest->name }}!</span>
        <span class="little_text">Questa è la tua pagina personale. Da qui potrai modificare le tue informazioni personali o aggiungere alla Lista Invitati i tuoi accompagnatori.</span>

        <form action="#" method="post" name="update_form" id="update_form">
            @csrf
            <fieldset name="personal">
                <legend>Informazioni Personali</legend>
                <span>Compila i campi con i tuoi dati. Ci serviranno solo Nome e Cognome.</span>
                <div class="labels">
                    <label for="update_name">Nome</label>
                    <label for="update_surname">Cognome</label>
                </div>

                <div class="inputs">
                    <input type="text" name="name" id="update_name" value="{{ $guest->name }}" placeholder="Nome">
                    <input type="text" name="surname" id="update_surname" value="{{ $guest->surname }}" placeholder="Cognome">
                </div>

                <div class="flags">
                    <p data-input="name"></p>
                    <p data-input="surname"></p>
                </div>

                <input data-field="personal" type="submit" value="Aggiorna Informazioni Personali" disabled>
            </fieldset>

            <fieldset name="food">
                <legend>Allergie e Stile Alimentare</legend>
                <div class="labels">
                    <label for="update_diet">Dieta</label>
                    <label for="update_allergies">Allergie</label>
                </div>

                <div class="inputs">
                    <input type="text" name="diet" id="update_diet" value="{{ $guest->diet == 'nessuna' ? '' : $guest->diet }}" placeholder="(Es: vegetariano)">
                    <input type="text" name="allergies" id="update_allergies" value="{{ $guest->allergies == 'nessuna' ? '' : $guest->allergies }}" placeholder="(Es: lattosio, glutine, ecc.)">
                </div>

                <div class="flags">
                    <p data-input="diet"></p>
                    <p data-input="allergies"></p>
                </div>

                <input data-field="food" type="submit" value="Aggiorna Informazioni Alimentari" disabled>
            </fieldset>

            <fieldset name="presence">
                <legend>Conferma Presenza</legend>
                <div class="labels">
                    <p>Sarai presente alla Cerimonia?</p>
                    <p>Sarai presente al Ricevimento?</p>
                </div>

                <div class="inputs">
                    <div>
                        <label>Sì<input type="radio" name="church_confirmed" value="true"></label>
                        <label>No<input type="radio" name="church_confirmed" value="false"></label>
                    </div>

                    <div>
                        <label>Sì<input type="radio" name="party_confirmed" value="true"></label>
                        <label>No<input type="radio" name="party_confirmed" value="false"></label>
                    </div>
                </div>

                <div class="flags">
                    <p data-input="church_confirmed"></p>
                    <p data-input="party_confirmed"></p>
                </div>

                <input data-field="presence" type="submit" value="Aggiorna Informazioni Presenze" disabled>
            </fieldset>

            <input type="submit" value="Salva i tuoi dati!">
        </form>

        <div class="dialogs"></div>
    
    </section>
@endsection