<span class="hero">
    <p>Ciao {{ $guest->name }}!</p>
    <img src="{{ Storage::url('images/hello.png') }}">
</span>

<span class="mid-dialog">
    <p>Per organizzare al meglio l'evento, avremmo bisogno che tu
        ci fornisca qualche informazione.</p>
    <p>Quando sei pronto possiamo cominciare!</p>
</span>

<button class="ready-button" tabindex="-1">Cominciamo</button>