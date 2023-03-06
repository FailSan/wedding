@extends('guest.dashboard')


@section('content')

    <form action="#" method="post" name="guest_form" id="guest_form">
        @csrf

        <div class="labels">
            <label for="create_name">Nome Invitato</label>
            <label for="create_surname">Cognome Invitato</label>
            <label for="create_diet">Dieta Invitato</label>
            <label for="create_allergies">Allergie Invitato</label>
            <label for="create_confirmed">Conferma Invitato</label>
        </div>

        <div class="inputs">
            <input type="text" name="name" id="create_name" placeholder="(Es: Piero, Antonio, ecc.)">
            <input type="text" name="surname" id="create_surname" placeholder="(Es: Rossi, Biagi, ecc.)">
            <input type="text" name="diet" id="create_diet" placeholder="(Es: vegetariana, vegana, onnivora, ecc.)">
            <input type="text" name="allergies" id="create_allergies" placeholder="(Es: lattosio, glutine, ecc.)">
            <input type="checkbox" name="confirmed" id="create_confirmed">
        </div>

        <input type="submit" value="Crea Invitato">
    </form>

    <div class="dialogs"></div>

    <div class="guests">
        @foreach($guest->guests as $extra)
            <span>
                <p>{{ $extra->name }}</p>
                <p>{{ $extra->surname }}</p>
                <p>{{ $extra->diet }}</p>
                <p>{{ $extra->allergies }}</p>
            </span>
        @endforeach
    </div>
@endsection