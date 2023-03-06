@extends('structure')

@section('title', "Pagina di Registrazione")

@section('scripts')
    <script src="{{ asset('scripts/home.js') }}" defer></script>
@endsection

@section('content')

    <form action="#" method="post" name="signup_form" id="signup_form">
        @csrf

        <div class="labels">
            <label for="signup_name">Nome</label>
            <label for="signup_surname">Cognome</label>
            <label for="signup_email">E-Mail</label>
            <label for="signup_password">Password</label>
            <label for="signup_password_confirmation">Conferma Password</label>
        </div>
        
        <div class="inputs">
            <input type="text" name="name" id="signup_name" placeholder="Nome">
            <input type="text" name="surname" id="signup_surname" placeholder="Cognome">
            <input type="mail" name="email" id="signup_email" placeholder="esempio@gmail.com">
            <input type="password" name="password" id="signup_password" placeholder="******">
            <input type="password" name="password_confirmation" id="signup_password_confirmation" placeholder="******">
        </div>
        
        <input type="submit" value="Registrati">
    </form>

    <div class="dialogs"></div>

@endsection