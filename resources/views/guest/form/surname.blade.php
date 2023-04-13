<form action="#" method="post" id="surname_form" data-form-sel="0" data-content="surname">
    @csrf

    <span class="top-section">
        <p class="brown">2 / 4</p>
        <p class="mid">Bene! Ed il tuo <i>cognome</i>?</p>
    </span>

    <div class="mid-section">
        <label class="main-input">
            <p>Cognome</p>
            <input type="text" name="surname" value="{{ $guest->surname }}" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-box hidden"></span>

        <input type="submit" value="Conferma" tabindex="-1">
    </div>
    
    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Ti chiederemo di confermare i tuoi dati anagrafici principali.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            <strong>Conferma</strong> e andare avanti.</p>
    </span>
</form>