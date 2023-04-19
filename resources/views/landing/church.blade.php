<span class="head">
    <span class="top">
        <img class="photos" src="{{ Storage::url('images/church_01.png') }}">
    </span>
    
    <span class="right">
        <img class="photos" src="{{ Storage::url('images/church_02.png') }}">
    </span>
</span>

<span class="content">
    <p class="brown">{{ __("Cerimonia") }}</p>
    <span class="mid-dialog">
        <p class="mid">{{ __("Chiara la conoscete anche voi. Siamo consapevoli che la aspetteremo, sotto un sole da 40 gradi, al centro di Catania?") }}</p>
        <p class="mid">{{ __("Ma quando mai? Il tempo di un paio di email e di mettermi le scarpe. Tanto voi mica avete altri impegni.") }}</p>
    </span>
    
    <span class="hour">
        <p>[{{ __("dalle ore") }}]</p>
        <p class="big">16.30</p>
    </span>
</span>

<div class="location">
    <p>[{{ __("nella Chiesa di") }}]</p>
    <span class="title">
        <p class="big">S. Francesco</p>
        <p class="big">d'Assisi All'Immacolata</p>
        <img class="photos" src="{{ Storage::url('images/church_00.png') }}">
    </span>

    <span class="maps">
        <p>Piazza S. Francesco d'Assisi, 2<br>95124 Catania CT</p>
        <a class="directions" href="https://goo.gl/maps/THDnKCXCdWHd2Kmw5">
            <p>{{ __("Raggiungere la Chiesa") }}</p>
            <img src="{{ Storage::url('images/map.svg') }}">
        </a>
    </span>
</div>