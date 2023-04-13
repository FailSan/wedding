<form class="hidden" action="#" method="post" id="extra_guests_form" data-form-sel="1" data-content="extra_guests">
    @csrf

    <span class="top-section">
        <p class="brown">8 / 8</p>
        <p class="mid">Aggiungi gli ospiti che desideri invitare.</p>
        <p>Inserisci i loro dati e quando avrai finito, clicca Conferma e vai avanti!</p>
    </span>
    
    <div class="mid-section">
        <fieldset class="extra-guests-container"></fieldset>

        <fieldset class="mini-form">
            <label class="main-input">
                <p>Nome</p>
                <input class="mini" type="text" name="name" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="main-input">
                <p>Cognome</p>
                <input class="mini" type="text" name="surname" placeholder=" " autocomplete="off"  tabindex="-1">
            </label>

            <label class="main-input">
                <p>Dieta (Onnivoro, vegetariano, ecc.)</p>
                <input class="mini" type="text" name="diet" placeholder=" " autocomplete="off" tabindex="-1">
            </label>

            <label class="main-input">
                <p>Allergie (Glutine, lattosio, ecc.)</p>
                <input class="mini" type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-box hidden"></span>

        <div class="submit-container">
            <button class="add-guest" tabindex="-1">
                <p>Aggiungi Ospite</p>
            </button>

            <input type="submit" value="Conferma" tabindex="-1">
        </div>
    </div>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Compila i campi e clicca su "Aggiungi Ospite".
            Premi "Conferma" per completare la registrazione.</p>
    </span>
</form>