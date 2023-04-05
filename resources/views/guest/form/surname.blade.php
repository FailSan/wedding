<form action="#" method="post" id="surname_form" data-form-sel="0" data-content="surname">
    @csrf

    <p class="brown">2 / 4</p>

    <p class="mid">Bene! Ed il tuo <i>cognome</i>?</p>
    <input type="text" name="surname" value="{{ $guest->surname }}" placeholder="Cognome" autocomplete="off" tabindex="-1">

    <p class="error-box hidden"></p>

    <label class="submit-label">
        <input type="submit" value="Ok!" tabindex="-1">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Ti chiederemo di confermare i tuoi dati anagrafici principali.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            <strong>Ok</strong> e andare avanti.</p>
    </span>
</form>