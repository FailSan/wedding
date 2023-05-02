<span class="hero">
    <p class="main-title">{{ __("Ciao :Name!", ['Name' => $guest->name ]) }}</p>
    <img src="{{ Storage::url('images/hello-animation.png') }}">
</span>

<span class="mid-dialog">
    <p>{{ __("Per organizzare al meglio l'evento, avremmo bisogno che tu ci fornisca qualche informazione.") }}</p>
    <p>{{ __("Quando sei pronto possiamo cominciare!") }}</p>
</span>

<button id="ready" class="cta-button input-button" tabindex="-1">
    {{ __("Cominciamo") }}
</button>