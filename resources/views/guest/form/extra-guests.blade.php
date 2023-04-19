<form class="hidden" action="#" method="post" id="extra_guests_form" data-form-sel="0" data-content="extra_guests">
    @csrf

    <span class="top-section">
        <p class="brown">8 / 8</p>
        <p class="mid">{{ __("Aggiungi gli ospiti che desideri invitare.") }}</p>
        <p>{{ __("Inserisci i loro dati e quando avrai finito, clicca 'Conferma' e vai avanti!") }}</p>

        <fieldset class="extra-guests-container"></fieldset>

        <fieldset class="mini-form">
            <label class="main-input">
                <p>{{ __("Nome") }}</p>
                <input class="mini" type="text" name="name" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="main-input">
                <p>{{ __("Cognome") }}</p>
                <input class="mini" type="text" name="surname" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="main-input">
                <p>{{ __("Dieta") }}</p>
                <input class="mini" type="text" name="diet" placeholder=" " autocomplete="off" tabindex="-1">
            </label>

            <label class="main-input">
                <p>{{ __("Allergie") }}</p>
                <input class="mini" type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-box hidden"></span>

        <div class="submit-container">
            <button class="add-guest" tabindex="-1">
                <p>{{ __("Aggiungi Ospite") }}</p>
            </button>

            <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
        </div>
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Compila i campi e clicca su 'Aggiungi Ospite'.
            Premi 'Conferma' per completare la registrazione.") }}</p>
    </span>
</form>