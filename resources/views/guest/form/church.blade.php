<form action="#" method="post" id="church_form" data-form-sel="0" data-content="church_confirm">
    @csrf

    <span class="top-section">
        <p class="brown">3 / 4</p>
        <p class="mid">{{ __("Sarai presente alla") }} <i>{{ __("Cerimonia") }}</i>?</p>

        <fieldset class="radio-group">
            <label class="radio-label yes">
                <p>{{ __("Sì, ci sarò!") }}</p>
                <input type="radio" name="church_confirm" value="true" tabindex="-1">
            </label>

            <label class="radio-label no">
                <p>{{ __("No, mi spiace.") }}</p>
                <input type="radio" name="church_confirm" value="false" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-box hidden"></span>

        <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("La cerimonia si svolgerà alle 16.30 presso la Chiesa di San Francesco d'Assisi
            All'Immacolata. Abbiamo bisogno di sapere in anticipo se ci sarai.") }}</p>
    </span>
</form>