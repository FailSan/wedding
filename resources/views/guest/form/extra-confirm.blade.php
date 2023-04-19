<form class="hidden" action="#" method="post" id="extra_confirm_form" data-form-sel="0" data-content="extra_confirm">
    @csrf

    <span class="top-section">
        <p class="brown">7 / 7</p>
        <p class="mid">{{ __("Pensi di portare altri") }} <i>{{ __("Ospiti") }}</i> {{ __("con te?") }}</p>

        <fieldset class="radio-group">
            <label class="radio-label yes">
                <p>{{ __("Sì, ho qualche ospite!") }}</p>
                <input type="radio" name="extra_confirm" value="true" tabindex="-1">
            </label>

            <label class="radio-label no">
                <p>{{ __("No, non porto nessuno con me.") }}</p>
                <input type="radio" name="extra_confirm" value="false" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-box hidden"></span>

        <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Puoi portare con te qualcuno se vuoi, assicurati però di inserire i
            suoi dati corretti.") }}</p>
    </span>
</form>