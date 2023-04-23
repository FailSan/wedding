<nav class="top-nav">
    <a href="/">Homepage</a>

    @guest
    <a href="/user">Login</a>
    <a href="/user/signup">Registrazione</a>
    @endguest

    @auth
    <a href="/user/administration/guests">Amministrazione</a>
    <a href="/user/logout">Logout</a>
    @endauth
</nav>