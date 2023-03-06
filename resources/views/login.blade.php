@extends('structure')

@section('title', "Pagina di Login")

@section('scripts')
    <script src="{{ asset('scripts/home.js') }}" defer></script>
@endsection

@section('content')

    <form action="#" method="post" name="login_form" id="login_form">
        @csrf

        <div class="labels">
            <label for="login_email">E-Mail</label>
            <label for="login_password">Password</label>
            <label for="login_remember">Ricordami</label>
        </div>

        <div class="inputs">
            <input type="mail" name="email" id="login_email" placeholder="esempio@gmail.com"></label>
            <input type="password" name="password" id="login_password" placeholder="******">
            <input type="checkbox" name="remember" id="login_remember">
        </div>

        <input type="submit" value="Entra">
    </form>

    <div class="dialogs"></div>

@endsection