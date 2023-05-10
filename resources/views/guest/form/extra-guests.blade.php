<form class="hidden" action="#" method="post" id="extra_guests_form" data-form-sel="0" data-content="extra_guests">
    @csrf

    <span class="top-section">
        <p class="brown-heading">8 / 8</p>
        <p class="main-dialog">{{ __("Aggiungi gli ospiti che desideri invitare.") }}</p>
        <p>{{ __("Inserisci i loro dati e quando avrai finito, clicca Conferma e vai avanti!") }}</p>

        <fieldset class="extra-guests-container"></fieldset>

        <fieldset class="mini-form">
            <label class="text-label">
                <p>{{ __("Nome") }}</p>
                <input type="text" name="name" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="text-label">
                <p>{{ __("Cognome") }}</p>
                <input type="text" name="surname" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="text-label">
                <p>{{ __("Dieta") }}</p>
                <input type="text" name="diet" placeholder=" " autocomplete="off" tabindex="-1">
            </label>

            <label class="text-label">
                <p>{{ __("Allergie") }}</p>
                <input type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
            </label>

            <label class="check-label">
                <p>{{ __("Prepariamo un Menu per bambini?") }}</p>
                <input type="checkbox" name="child_menu" value="true" autocomplete="off" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-dialog hidden"></span>

        <div class="submit-container">
            <button class="cta-button action-button add-guest" tabindex="-1">
                <p>{{ __("Aggiungi Ospite") }}</p>
            </button>

            <input class="cta-button input-button" type="submit" value="{{ __('Conferma') }}" tabindex="-1">
        </div>
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey-dialog">{{ __("Compila i campi e clicca su 'Aggiungi Ospite'. Premi 'Conferma' per completare la registrazione.") }}</p>
    </span>
</form>