<form class="hidden" action="#" method="post" id="allergies_form" data-form-sel="0" data-content="allergies">
    @csrf

    <span class="top-section">
        <p class="brown">6 / 7</p>
        <p class="mid">Soffri di <i>allergie</i> particolari? Indicacele tutte scrivendo gli allergeni 
            uno dopo l'altro separandoli con una virgola.</p>
    </span>
    
    <div class="mid-section">
        <label class="main-input">
            <p>Glutine, lattosio, pesche, aglio, ecc...</p>
            <input type="text" name="allergies" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-box hidden"></span>

        <input type="submit" value="Conferma" tabindex="-1">
    </div>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Dato che sarai nostro ospite al ricevimento, ti chiediamo di 
            informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.</p>
    </span>
</form>