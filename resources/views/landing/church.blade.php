<div class="head">
    <div class="top">
        <img class="photos" src="{{ Storage::url('images/church_01.png') }}">
    </div>
    
    <div class="right">
        <img class="photos" src="{{ Storage::url('images/church_02.png') }}">
    </div>
</div>

<span class="content">
    <p class="brown-heading">{{ __("Cerimonia") }}</p>
    <span class="mid-dialog">
        <p class="main-dialog">{{ __("La tradizione vuole che le spose si facciano attendere. Sotto il sole dell'estate, al centro di Catania. Per continuare con la comodità.") }}</p>
    </span>
    
    <span class="hour">
        <p>[{{ __("dalle ore") }}]</p>
        <p class="main-title">16.30</p>
    </span>
</span>

<div class="location">
    <p>[{{ __("nella Chiesa di") }}]</p>
    <span class="title">
        <p class="main-title">S. Francesco</p>
        <p class="main-title">d'Assisi All'Immacolata</p>
        <img class="photos" src="{{ Storage::url('images/church_00.png') }}">
    </span>

    <span class="maps">
        <p>Piazza S. Francesco d'Assisi, 2<br>95124 Catania CT</p>
        <a href="https://goo.gl/maps/THDnKCXCdWHd2Kmw5">
            <button class="cta-button action-button directions">
                {{ __("Raggiungere la Chiesa") }}
            </button>
        </a>
    </span>
</div>