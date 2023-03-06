<a href="/"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>
<img class="opener" data-open="0" src="{{ Storage::url('images/menu_open.svg') }}">

<span class="language">
    <p data-lang="it" class="selected">IT</p>
    <p>\</p>
    <p data-lang="en">EN</p>
</span>

<menu class="hidden">
    @include('landing.menu')
</menu>