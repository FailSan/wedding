<form action="#" method="post" id="church_form" data-form-sel="0" data-content="church_confirm">
    @csrf

    <p class="brown">3 / 4</p>

    <p class="mid">Sarai presente alla <i>Cerimonia?</i></p>

    <fieldset class="radio-group">
        <label class="radio-label">
            <p>Sì, ci sarò!</p>
            <img src="{{ Storage::url('images/yes.svg') }}">
            <input type="radio" name="church_confirm" value="true">
        </label>

        <label class="radio-label">
            <p>No, mi spiace.</p>
            <img src="{{ Storage::url('images/no.svg') }}">
            <input type="radio" name="church_confirm" value="false">
        </label>
    </fieldset>

    <p class="error-box hidden"></p>

    <label class="submit-label">
        <input type="submit" value="Ok!">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">La cerimonia si svolgerà alle 16.30 presso la Chiesa di San Francesco d'Assisi
            All'Immacolata.
            <br>Abbiamo bisogno di sapere in anticipo se ci sarai.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            Ok e andare avanti.</p>
    </span>
</form>