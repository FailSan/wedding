<form class="hidden" action="#" method="post" id="allergies_form" data-form-sel="0" data-content="allergies">
    @csrf

    <p class="brown">6 / 7</p>

    <p class="mid">Soffri di <i>allergie</i> particolari? Indicacele tutte scrivendo gli allergeni 
        uno dopo l'altro separandoli con una virgola.</p>
    <input type="text" name="allergies" value="" 
    placeholder="Glutine, lattosio, pesche, aglio, ecc..." 
    autocomplete="off">

    <p class="error-box hidden"></p>

    <label class="submit-label">
        <input type="submit" value="Ok!">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Dato che sarai nostro ospite al ricevimento, ti chiediamo di 
            informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            <strong>Ok</strong> e andare avanti.</p>
    </span>
</form>