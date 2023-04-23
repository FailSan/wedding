@extends('user.structure')

@section('scripts')
    <script src="{{ asset('scripts/home.js') }}" defer></script>
@endsection

@section('content')

    <form action="#" method="post" name="login_form" id="login_form">
        @csrf

        <label class="text-label">
            <p>E-Mail</p>
            <input type="mail" name="email" placeholder=" ">
        </label>

        <label class="text-label">
            <p>Password</p>
            <input type="password" name="password" placeholder=" ">
        </label>

        <label class="check-label">
            <p>Ricordami</p>
            <input type="checkbox" name="remember">
        </label>

        <span class="error-dialog hidden"></span>

        <input class="cta-button input-button" type="submit" value="Entra">
    </form>

@endsection