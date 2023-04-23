<a href="/"><img class="logo" src="{{ Storage::url('images/logo.svg') }}"></a>

<img class="opener" data-open="0" src="{{ Storage::url('images/menu_open.svg') }}">

<span class="language">
    <p data-lang="it" @class(["selected" => app()->getLocale() == "it"])><a href="lang/it">IT</a></p>
    <p>\</p>
    <p data-lang="en" @class(["selected" => app()->getLocale() == "en"])><a href="lang/en">EN</a></p>
</span>

<div class="percentage"></div>

<menu class="hidden">
    @include('landing.menu')
</menu>