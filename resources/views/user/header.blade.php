<navbar>
    <a href="/">Landing</a>

    @guest
    <a href="/user/login">Login</a>
    <a href="/user/signup">Registrazione</a>
    @endguest

    @auth
    <a href="/user/administration">Amministrazione</a>
    <a href="/user/logout">Logout</a>
    @endauth
</navbar>