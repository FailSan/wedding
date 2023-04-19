<form action="#" method="post" id="surname_form" data-form-sel="0" data-content="surname">
    @csrf

    <span class="top-section">
        <p class="brown">2 / 4</p>
        <p class="mid">{{ __("Bene! Ed il tuo") }} <i>{{ __("Cognome") }}</i>?</p>

        <label class="main-input">
            <p>{{ __("Cognome") }}</p>
            <input type="text" name="surname" value="{{ $guest->surname }}" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-box hidden"></span>

        <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>
    
    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Ti chiederemo di confermare i tuoi dati anagrafici principali. Se i dati pre-inseriti dovessero essere corretti, puoi premere") }}
            <strong>{{ __("Conferma") }}</strong> {{__("e andare avanti.") }}</p>
    </span>
</form>