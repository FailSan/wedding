@extends('user.structure')

@section('scripts')
    <script src="{{ asset('scripts/home.js') }}" defer></script>
@endsection

@section('content')

    <form action="#" method="post" name="signup_form" id="signup_form">
        @csrf

        <label class="text-label">
            <p>Nome</p>
            <input type="text" name="name" placeholder=" ">
        </label>

        <label class="text-label">
            <p>Cognome</p>
            <input type="text" name="surname" placeholder=" ">
        </label>

        <label class="text-label">
            <p>E-Mail</p>
            <input type="mail" name="email" placeholder=" ">
        </label>

        <label class="text-label">
            <p>Password</p>
            <input type="password" name="password" placeholder=" ">
        </label>

        <label class="text-label">
            <p>Conferma Password</p>
            <input type="password" name="password_confirmation" placeholder=" ">
        </label>
        
        <span class="error-dialog"></span>

        <input class="cta-button input-button" type="submit" value="Registrati">
    </form>

@endsection