@extends('guest.landing')

@section('content')

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

@endsection