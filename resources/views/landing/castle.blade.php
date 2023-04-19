<span class="head">
    <span class="top">
        <img class="photos" src="{{ Storage::url('images/castle_01.png') }}">
    </span>
    
    <span class="right">
        <img class="photos" src="{{ Storage::url('images/castle_02.png') }}">
    </span>
</span>

<span class="content">
    <p class="brown">{{ __("Ricevimento") }}</p>
    <span class="mid-dialog">
        <p class="mid">{{ __("Ho visto in una puntata dei Simpson che il riso crudo fa esplodere gli uccelli. 
            E quindi vediamo se è vero.") }}</p>
        <p class="mid">{{ __("Dopo le eventuali esplosioni, vi invitiamo ad aspettarci per il ricevimento.") }}</p>
    </span>

    <span class="hour">
        <p>[{{ __("dalle ore") }}]</p>
        <p class="big">19.00</p>
    </span>
</span>

<div class="location">
    <p>[{{ __("al") }}]</p>
    <span class="title">
        <p class="big">Castello Xirumi</p>
        <p class="big">Serravalle</p>
        <img class="photos" src="{{ Storage::url('images/castle_00.png') }}">
    </span>

    <span class="maps">
        <p>SP69ii<br>96016 Lentini SR</p>
        <a class="directions" href="https://goo.gl/maps/owFSaBEnTb4YP1kD8">
            <p>{{ __("Raggiungere il Castello") }}</p>
            <img src="{{ Storage::url('images/map.svg') }}">
        </a>
    </span>
</div>