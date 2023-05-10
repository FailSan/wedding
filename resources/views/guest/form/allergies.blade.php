<form class="hidden" action="#" method="post" id="allergies_form" data-form-sel="0" data-content="allergies">
    @csrf

    <span class="top-section">
        <p class="brown-heading">6 / 7</p>
        <p class="main-dialog">{{ __("Soffri di") }} <i>{{ __("Allergie") }}</i>  {{ __("particolari? Indicacele tutte scrivendo gli allergeni uno dopo l'altro separandoli con una virgola.") }}</p>
        
        <label class="text-label">
            <p>{{ __("Glutine, lattosio, pesche, aglio, ecc...") }}</p>
            <input type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-dialog hidden"></span>

        <input class="cta-button input-button" type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey-dialog">{{ __("Dato che sarai nostro ospite al ricevimento, ti chiediamo di informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.") }}</p>
    </span>
</form>