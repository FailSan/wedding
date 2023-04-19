<form class="hidden" action="#" method="post" id="allergies_form" data-form-sel="0" data-content="allergies">
    @csrf

    <span class="top-section">
        <p class="brown">6 / 7</p>
        <p class="mid">{{ __("Soffri di") }} <i>{{ __("Allergie") }}</i> {{ __("particolari? Indicacele tutte scrivendo gli allergeni 
            uno dopo l'altro separandoli con una virgola.") }}</p>
        
        <label class="main-input">
            <p>{{ __("Glutine, lattosio, pesche, aglio, ecc...") }}</p>
            <input type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-box hidden"></span>

        <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Dato che sarai nostro ospite al ricevimento, ti chiediamo di 
            informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.") }}</p>
    </span>
</form>