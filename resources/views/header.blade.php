<navbar>
    <a href="/">Landing</a>
    
    @if(request()->cookie('code'))
    <a href="/guest">Area Invitato</a>
    @endif

    @guest
    <a href="/login">Login</a>
    <a href="/signup">Registrazione</a>
    @endguest

    @auth
    <a href="/user/administration">Amministrazione</a>
    <a href="/user/logout">Logout</a>
    @endauth
</navbar>